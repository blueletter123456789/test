<?php
	// GS_PLUGIN_URL
	require_once '../../../../wp-load.php';
	
	// 投稿タイプのpostデータ取得
	$post_type = (isset($_POST['post_type_name'])) ? $_POST['post_type_name'] : 'post';
	$post_check = true;

	// 存在する投稿タイプであるか

	// 存在しない場合、エラーメッセージ出力・中断処理
	if($post_type==false){
		echo '投稿タイプが選択されておりません。再度、ダウンロード画面をリロード（再読み込み）の上、「投稿タイプの選択」を行い、CSVファイルのダウンロードを行ってください。';
		exit();
	}

	$news_args = [
		'post_type' => $post_type,
    	'post_status' => 'publish',
    	'orderby' => 'date',
    	'order' => 'asc',
    	'posts_per_page' => -1,
    ];
    if (isset($_POST['beforeDate']) && isset($_POST['afterDate'])) {
		if(!dateCheck($_POST['beforeDate']) || !dateCheck($_POST['afterDate'])){
			echo '対象の日付の入力内容にエラーが確認されました。対象の日付の入力内容をご確認の上、再度実行してください。';
			exit();
		}

    	$afterDate = $_POST['afterDate'];
    	$beforeDate = $_POST['beforeDate'];

    	// 日付前後置換処理
		// if(!dateCompair($_POST['beforeDate'], $_POST['afterDate'])){
		// 	$afterDate = $_POST['beforeDate'];
		// 	$beforeDate = $_POST['afterDate'];
		// }

    	$news_args += [
	    	'date_query' => [
				'compare'=>'BETWEEN',
				'inclusive'=>true,
				'after'=>$afterDate,
				'before'=>$beforeDate,
	    	],
		];
    }elseif (isset($_POST['beforeDate']) && !isset($_POST['afterDate'])) {
    	if(!dateCheck($_POST['beforeDate'])){
			echo '対象の日付の入力内容にエラーが確認されました。対象の日付の入力内容をご確認の上、再度実行してください。';
			exit();
		}
    	$beforeDate = $_POST['beforeDate'];
    	$news_args += [
	    	'date_query' => [
				'compare'=>'>=',
				'inclusive'=>true,
				'before'=>$beforeDate,
	    	],
		];
    }elseif (!isset($_POST['beforeDate']) && isset($_POST['afterDate'])) {
    	if(!dateCheck($_POST['afterDate'])){
			echo '対象の日付の入力内容にエラーが確認されました。対象の日付の入力内容をご確認の上、再度実行してください。';
			exit();
		}
    	$afterDate = $_POST['afterDate'];
    	$news_args += [
	    	'date_query' => [
				'compare'=>'<=',
				'inclusive'=>true,
				'after'=>$afterDate,
	    	],
		];
    }


    // Query成形
	$gs_query = new WP_Query($news_args);

	// CSV 項目名セット
	$csv[] = ["ITEM_NAME","ITEM_DESCRIPTION","ITEM_URL"];

	if ($gs_query->have_posts()) { 						// 取得した記事データが存在するかしないかの判定
		while ($gs_query->have_posts()) { 				// 記事データが存在する場合、その記事データに対してループ処理を実行
			$gs_query->the_post(); 						// 次の記事データへ
			$csv[] = [
				contentsReplace($gs_query->post->post_title),
				esc_html(wp_strip_all_tags(contentsReplace($gs_query->post->post_content))),
				get_permalink(),
			];
		}	// /while

		// CSV OUTPUT
		$filename = 'GS-'.date('Y_m_d').'.csv';
		$filepath = GS_PLUGIN_PATH . '/csv/'. $filename;
		$fp = fopen( $filepath, 'w' );
		fwrite($fp, "\xEF\xBB\xBF");		// BOM

		// 配列をカンマ区切りにしてファイルに書き込み
		foreach ( $csv as $fields ) {
			fputcsv( $fp, $fields );
			// fputcsv( $fp, convText($fields) );	// 文字エンコーディング変換
		}

		// ダウンロード設定
		header( 'Content-Type:application/octet-stream' );
		header( 'Content-Disposition:filename='.$filename );
		header( 'Content-Length:' . filesize( $filepath ) );
		readfile( $filepath );
		unlink( $filepath );
		exit();
	}else{
		echo "対象の記事が存在しませんでした。対象の日付の入力内容をご確認いただき、再度実行してください。";
		exit();
	}

	function contentsReplace($str){
		$str = preg_replace("/.+>$/", "\n", $str);
		$str = preg_replace('/<br *\/? *>/i', "", $str);
		$str = preg_replace("/\r\n|\n|\r/", "\n", $str);
		// $str = str_replace(',', '、', $str);
		// $str = str_replace("'", "’", $str);
		return str_replace('"', '”', $str);
	}
	function dateCheck($str){
		return ( preg_match('/(\d{4}-\d{2}-\d{2})|(\d{4}\/\d{2}\/\d{2})/', $str) ) ? true : false;
	}
	function convText($str){
		return mb_convert_encoding($str,"SJIS", "UTF-8");
	}
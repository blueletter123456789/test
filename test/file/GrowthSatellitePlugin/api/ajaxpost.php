<?php
	// GS_PLUGIN_URL
	require_once '../../../../wp-load.php';

	$news_args = [
		'post_type' => 'post',
    	'post_status' => 'publish',
    	'orderby' => 'date',
    	'order' => 'asc',
    ];
    if (isset($_POST['beforeDate']) && isset($_POST['afterDate'])) {
		if(!dateCheck($_POST['beforeDate']) || !dateCheck($_POST['afterDate'])){
			echo '対象の日付の入力内容にエラーが確認されました。対象の日付の入力内容をご確認の上、再度実行してください。';
			exit();
		}

    	$afterDate = $_POST['afterDate'];
    	$beforeDate = $_POST['beforeDate'];

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
	$check = ($gs_query->have_posts()) ? 1 : 0;

	echo $check;

	exit();
	function dateCheck($str){
		return ( preg_match('/(\d{4}-\d{2}-\d{2})|(\d{4}\/\d{2}\/\d{2})/', $str) ) ? true : false;
	}
<?php
	global $GScomm;
	$wp_query_args = [
		// 'post_type' => 'post',
    	'post_status' => 'publish',
    	'orderby' => 'date',
    	'order' => 'ASC',
    ];
    $gs_query = new WP_Query($wp_query_args);
    $olddate = ($gs_query->have_posts()) ? date("Y-m-d", strtotime($gs_query->post->post_date)) : date("Y-m-d");
    $nowdate = date("Y-m-d");

    $args = array(
		'public'   => true,
		// '_builtin' => false,
	);

	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'

	$post_types = get_post_types( array( 'public'=>true ));
	$post_type_name = ['post' => '投稿ページ', 'page' => '固定ページ'];
	$remove_post_type = ['nav_menu_item' => 'ナビゲーションメニュー', 'attachment' => '添付ファイル', 'revision' => '下書き'];
	// var_dump($post_types);exit();
	// var_dump($post_types);
	// exit();
?>
<div id="ajax_loading" class="inactive">
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<p>	ただいま、更新・反映処理を行っております。最大1分ほどかかります。<br>
		途中で離れてしまうと予期せぬエラーが発生してしまう場合がございます。<br>
		ご了承ください。</p>
</div>
<div class="GS_wrapper">
	<h2>Growth Satelliteの使い方</h2>
	<div class="GS_steps">
		<div>
			<h3>STEP 1</h3>
			<div>
				<p>Growth Satelliteで必要なCSVファイルをダウンロードしてください。まずは、対象となる記事の期間を選択をしてください。</p>
			</div>
			<div id="period">
				<input id="periodall" type="radio" name="period" value="0" checked><label for="periodall">全期間</label>
				<input id="perioddesign" type="radio" name="period" value="1"><label for="perioddesign">期間指定</label>
			</div>
			<div>


			</div>
			<form id="dateform" method="post" action="<?php echo GS_PLUGIN_URL . '/api/download.php' ?>" target="_blank">
				<div id="dateParam">
					<p id="after_alert"></p>
					<div id="after">
						<label for="afterDate">開始日</label><input id="afterDate" type="date" name="afterDate" value="<?php echo $olddate; ?>" placeholder="2020-06-01" disabled required>
					</div>
					<p id="before_alert"></p>
					<div id="before">
						<label for="beforeDate">終了日</label><input id="beforeDate" type="date" name="beforeDate" value="<?php echo $nowdate; ?>" placeholder="2020-06-01" disabled required>
					</div>
				</div>
				<?php

				echo '<div id="post_type_select">';
				echo '<select name="post_type_name">';
					foreach ($post_types as $key => $value) {
						if( isset($remove_post_type[$key]) ) continue;
						$post_name = (isset($post_type_name[$key])) ? $post_type_name[$key] : 'カスタム投稿ページ';
						echo '<option value="' . esc_html($value) . '">' . esc_html($value) .' : '. esc_html($post_name) .'</option>';
					}
				echo '</select>';
				echo '</div>';
				?>
				<p id="post_alert"></p>
				<label id="download_label" for="download">DOWNLOAD</label><input id="download" type="button" name="download" onclick="submit();" value="DOWNLOAD">
			</form>
		</div>
		<div>
			<h3>STEP 2</h3>
			<div>
				<p>Growth Satellite（下の画面）にある、タグ作成タブにSTEP１でダウンロードしたCSVファイルをアップロードしてください。<span class="orangeColor">(ここではCSVファイルのダウンロードは不要です。)</span></p>
			</div>
		</div>
		<div>
			<h3>STEP 3</h3>
			<div>
				<p>タグ作成タブでタグを作成した後は、アイテム一覧タブに期待されるタグが付いているかを確認してください。タグの編集（名寄せや削除）はタグ一覧タブから編集してください。</p>
			</div>
		</div>
		<div>
			<h3>STEP 4</h3>
			<div class="col_two">
				<p>タグの編集やアイテムとタグの紐づきに問題がなければ、タグを反映してください。</p>
				<input id="param" type="checkbox" name="param" value="1" checked>
				<label for="param">既存のタグを残す</label>
				<div>
					<?php if(!empty($taxonomyArr)){ ?>
					<div id="taxonomy">
						<select name="taxonomy_type">
							<?php
								foreach ($taxonomyArr as $key => $val) {
									echo '<option value="' . $val . '"">';
									echo esc_html($val);
									echo '</option>';
								}
							?>
						</select>
					</div>
					<?php } ?>
					<a id="tag" href="#tag">タグを反映する</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="GS_disp">
	<iframe id="GS_main_disp" src="https://growth-satellite.net/items"></iframe>
</div>
<!-- <div id="GS_disp_message">
	<span class="GS_text">右下部をドラッグすることでウィンドウのサイズを変更できます。</span>
	<span class="arrow_up"></span>
</div> -->
<script type="text/javascript">
	var gs_tag_api_url = "<?php echo GS_PLUGIN_URL . '/api/gs_tag_api.php' ?>";
	var gs_tag_ajax_url = "<?php echo GS_PLUGIN_URL . '/api/ajaxpost.php' ?>";
</script>


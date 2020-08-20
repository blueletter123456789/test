<?php
header('Content-Type: application/json');
/**
 * GET Request send.(cURL)
 *
 * @param  string $url
 * @param  array  $params
 * @return array|boolean $data
 */

require_once dirname(__FILE__) . '/../../../../wp-load.php';
global $GScomm;

$token = $GScomm->loginAuthGS();
$pageCount = 1;
$parameter = ['limit'=>100, 'page'=>$pageCount];
$arrayData['items'] = [];
$site_url = get_site_url();
$count_posts = wp_count_posts();

$posts_count_num = $count_posts->publish;
if($posts_count_num <= 0) returnFalse(); 										// 投稿記事が一つもない場合
if( count($GScomm->curlJson($token, $parameter)['items']) <=0 ) returnFalse();	// GS側にitemが一つもない場合

$dataArr = [];
$param = (isset($_GET['param'])) ? $_GET['param'] : 0;

while ( count($GScomm->curlJson($token, $parameter)['items']) > 0 ) {
	$parameter = ['limit'=>200, 'page'=>$pageCount];
	$arrayData['items'] = array_merge($arrayData['items'], $GScomm->curlJson($token, $parameter)['items']);
	foreach ($arrayData['items'] as $key => $value) {
		foreach ($value as $k => $v) {
			if($k=='url'){
				if(strpos($v, $site_url)!== false){
					if(url_to_postid($v) != 0){
						$partArr['id'] = url_to_postid($value['url']);
						$partArr['url'] = $value['url'];
						$partArr['tags'] = $value['user_tags'];
						$dataArr[] = $partArr;
					}elseif (url_to_postid(urldecode($v)) != 0) {
						$partArr['id'] = url_to_postid($value['url']);
						$partArr['url'] = $value['url'];
						$partArr['tags'] = $value['user_tags'];
						$dataArr[] = $partArr;
					}
				}
			}
		}
	}
	$pageCount++;
}

// 20200718_add start **********************************
(count($dataArr)>0) ? setTagInfo($dataArr) : returnFalse();	
// 20200718_add end ************************************

(count($dataArr)>0) ? GenTags($dataArr, $param) : returnFalse();	//対象データからタグの生成、対象データが存在しない場合exit


echo 'true';


function returnFalse(){
	echo 'false';
	exit();
}
function GenTags($data, $param){
	foreach ($data as $key => $value) {
		$tag = stripTags($value['tags']);
		// removeTags($value['id']);						//対象記事のタグ完全リセット
		if($param!=1) removeTags($value['id']);			//対象記事のタグをリセット処理
		wp_set_post_tags( $value['id'], $tag, true );	//対象記事のタグを付与処理
	}
}
function stripTags($tags){
	$tag = '';
	foreach ($tags as $key => $value) {
		($key==0) ? $tag = $value['name'] : $tag .= "," . $value['name'];
	}
	return $tag;
}
function removeTags($id){
	$tags = wp_get_post_tags($id, 'post_tag');
	$tags = (array)$tags;
	$arr=[];
	foreach ($tags as $key => $val) {
		$val = (array)$val;
		$arr[] = $val['name'];
	}
	return wp_remove_object_terms($id, $arr,"post_tag");
}
// 20200720_add start **********************************
function setTagInfo($dataArr){
	foreach ($dataArr as $gsPostData) {
		$post_tag_name = 'post_tag';
		$post_type = get_post_type($gsPostData['id']);
		if ($post_type != 'post') {
			$post_tag_name = 'custom_tag_'.$post_type;
		}
		foreach ($gsPostData['tags'] as $gs_value) {
			$wp_tags = (array)get_term_by('name', $gs_value['name'], $post_tag_name);
			if (isset($wp_tags) != false && $wp_tags[0] != false) {
				// タグ情報が既に存在する場合はスラッグと説明を追加
				$wp_tags['slug'] = $gs_value['slug'];
                $wp_tags['description'] = $gs_value['description'];
                $wp_tags['taxonomy'] = $post_tag_name;
                wp_update_term($wp_tags['term_id'], $post_tag_name, $wp_tags);
			}else{
				// タグ情報がない場合は追加
				$tmp_insert_tags['description'] = $gs_value['description'];
				$tmp_insert_tags['slug'] = $gs_value['slug'];
				wp_insert_term($gs_value['name'], $post_tag_name, $tmp_insert_tags);
				$tmp_insert_tags = array();
			}
			$wp_tags = array();
		}
	}
}
// 20200720_add end ************************************
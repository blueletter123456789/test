<?php
/**
 * Plugin Name: Growth Satellite
 * ##Plugin URI: https://riding.co.jp/dev/plugins/
 * Description: GrowthSatelliteへ投稿記事からタグを抽出し、各記事へタグ反映・出力を行うプラグイン
 * Author: 株式会社Riding
 * Version: 1.0.2
 * Author URI: https://riding.co.jp/
 * License: GPL2+
 * Text Domain: Growth-Satellite
 * Domain Path: /languages/
 *
 * @package GrowthSatellite
 */

require_once dirname(__FILE__) . '/common.php';

$GScomm = new commonGrowthSatellite();

add_action('init', 'GrowthSatellite::init');

// 20200801_add start **********************************
add_action('wp_loaded', function(){
    global $REMOVE_POST_TYPE;
    $REMOVE_POST_TYPE = ['post' => '投稿ページ', 'page' => '固定ページ', 'nav_menu_item' => 'ナビゲーションメニュー', 'attachment' => '添付ファイル', 'revision' => '下書き'];

    require_once dirname(__FILE__) . '/../../../wp-load.php';
    $post_types = get_post_types( array( 'public'=>true ));
    foreach ($REMOVE_POST_TYPE as $key => $value) {
        unset($post_types[$key]);
    }
    foreach ($post_types as $key => $value) {
            // register_taxonomy('custom_tag_'.$key,$key,get_taxonomy('post_tag'));
    $taxInfo = array(
        'hierarchical' => false, 
        'update_count_callback' => '_udpate_post_term_count', 
        'label' => 'カスタムタグ', 
        'public' => true, 
        'show_ui' => true, 
        'show_admin_column' => true, 
        'rewite' => false, 
    );
        register_taxonomy_for_object_type('custom_tag_'.$key, $key);
        register_taxonomy('custom_tag_'.$key,$key,$taxInfo);
    }
});
/*
add_action('init', function(){
    $REMOVE_POST_TYPE = ['post' => '投稿ページ', 'page' => '固定ページ', 'nav_menu_item' => 'ナビゲーションメニュー', 'attachment' => '添付ファイル', 'revision' => '下書き'];
    require_once dirname(__FILE__) . '/../../../wp-load.php';
    $post_types = get_post_types( array( 'public'=>true ));
    foreach ($REMOVE_POST_TYPE as $key => $value) {
        unset($post_types[$key]);
    }
    $taxInfo = array(
        'hierarchical' => false, 
        'update_count_callback' => '_udpate_post_term_count', 
        'label' => 'カスタムタグ', 
        'public' => true, 
        'show_ui' => true, 
        'show_admin_column' => true, 
    );
    foreach ($post_types as $key => $value) {
    }
});
*/
// 20200801_add end ************************************

class GrowthSatellite
{
    static function init()
    {
        session_start();
        return new self();
    }

    function __construct()
    {
        define('GS_MAIN', 'Growth-Satellite');
        define('GS_MAIN_PATH', 'Growth-Satellite');
        define('GS_SUB_TITLE', 'GS-Config');
        define('GS_SUB_PATH', 'Growth-Satellite-config');
        define('GS_MANAGE_OPTION', 'manage_options');

        if (is_admin() && is_user_logged_in()) {
            // メニュー追加
            add_action('admin_menu', [$this, 'set_plugin_menu']);
            add_action('admin_menu', [$this, 'set_plugin_sub_menu']);
            add_action('wp_print_scripts', [$this, 'add_scripts']);
        }
    }
    ## メインページ設定
    function set_plugin_menu(){
        global $GScomm;
        $func = ($GScomm -> loginAuthGS()) ? [$this, 'main_disp'] : [$this, 'config_disp'];
        if(isset($_POST['entry'])){
           $func = ($GScomm->entryPOST($_POST)) ? [$this, 'main_disp'] : [$this, 'config_disp'];
        };
        add_menu_page(
            GS_MAIN,                        /* ページタイトル*/
            GS_MAIN,                        /* メニュータイトル */
            GS_MANAGE_OPTION,               /* 権限 */
            GS_MAIN_PATH,                   /* ページを開いたときのURL */
            $func,                          /* メニューに紐づく画面を描画するcallback関数 */
            'dashicons-tag',                /* アイコン see: https://developer.wordpress.org/resource/dashicons/#tag */
            99                              /* 表示位置のオフセット */
        );
    }
    ## サブページ設定
    function set_plugin_sub_menu() {
        global $GScomm;
        if(isset($_POST['entry'])){
           $GScomm->entryPOST($_POST);
        };
        add_submenu_page(
            GS_MAIN, 		 				/* 親メニューのslug */
            GS_SUB_TITLE,					/* メニュータイトル */
            GS_SUB_TITLE,					/* メニュータイトル */
            GS_MANAGE_OPTION,				/* 権限 */
            GS_SUB_PATH,		            /* ページを開いたときのURL */
            [$this, 'config_disp']			/* メニューに紐づく画面を描画するcallback関数 */
        );
    }
    function main_disp(){
		$path = dirname(__FILE__) . '/html/';
		$temp = $path . 'main.php';
    	require_once $temp;
    }
    function config_disp(){
    	$path = dirname(__FILE__) . '/html/';
		$temp = $path . 'config.php';
		require_once $temp;
    }
    function add_scripts() {
        $dateVer = date("Ymdhis");
        wp_enqueue_style( 'style-name', untrailingslashit(plugins_url('', __FILE__)) . '/assets/css/main.css?' . $dateVer );
        wp_enqueue_script( 'smart-script', untrailingslashit(plugins_url('', __FILE__)) . '/assets/js/main.js', array( 'jquery' ), $dateVer, true );
    }
}

?>
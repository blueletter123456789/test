<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'database_name' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'user_name' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'password' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'hostname' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'TlsKrDxF+vJnL~5HsD5rzu~p/<F)#d`Z5x7_^Kl%I?I8m^{iQ/6f3F@7^nWY%^O[' );
define( 'SECURE_AUTH_KEY',  'y2U)8c7::afyUAvq(s:6:Ysokz|xTRL{8Gu~YFd%2->mFZ.:!>ORgv:zgc=ZORxe' );
define( 'LOGGED_IN_KEY',    'lzZ?t^2vm8cJ.qDY~R^u]f@ujoC?$K<U:n<|J?4qfoW`)4p8@Rwt(T6y(mJY&5Lq' );
define( 'NONCE_KEY',        'c{~70 If  phGr>M(ho3us2A]=H)P/9<.<o%NBy)?devc_20AmaQ,p ^A.#=11pf' );
define( 'AUTH_SALT',        ' f<Vm`)2XIuFjBqW={RhLNEM.:3XCo(K{rq,qnY3NEjC#.ycRAN$`}2@gm2[ldCr' );
define( 'SECURE_AUTH_SALT', '4H@`z_n`Twn+1._1%6[q>c<st-`6&1Nnc{Q*jAi0R 7r!7$C4PJKmU>sew$=6y{}' );
define( 'LOGGED_IN_SALT',   '{Lu:J3r>?=V<`]na1Z@Q#Ljg%~_-/R9Tv}Q&^o&{S`Ymo]3P:G=p#;:{n1]._eH@' );
define( 'NONCE_SALT',       '2J} m/E%t:pB:0ImiP5hcyt<NIlrWfTrg/P/CFp8~izSsI!@-bm,nZNsjVOpJu7F' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wpsa_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

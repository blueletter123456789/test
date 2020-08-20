<?php

/**
 *
 */
class commonGrowthSatellite
{

	function __construct(){
		define('GS_VERSION', '1.0.0');
		define('GS_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));
		define('GS_PLUGIN_PATH', dirname(__FILE__));
		define('GS_USER_CONFIG_PATH', dirname(__FILE__) . '/config/userconfig.json');
		define('GS_API_URL', 'http://api.drip-tag.com');
		define('GS_API_TOKEN_URL', 'http://api.drip-tag.com/v1/token/');
		define('GS_API_ITEMS_URL', 'http://api.drip-tag.com/v1/items/');
		define('GS_ALGO_PATTERN', 'AES-128-CBC');
		define('GS_ALGO_KEY','*****');
	}
	public $errorMessage = '';
	public function nowuri(){
		return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	}
	public function getUserConfig(){
		require_once(ABSPATH.'wp-admin/includes/file.php');
		if(WP_Filesystem()){
			global $wp_filesystem;
			if(!$wp_filesystem->get_contents(GS_USER_CONFIG_PATH)) return false;
			$encArr = $wp_filesystem->get_contents(GS_USER_CONFIG_PATH);
			$json = $this->decryptStr($encArr);
			$arr = json_decode($json, true);
			return $arr;
		}
		return false;
	}
	public function putUserConfig($arr){
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		if(WP_Filesystem()){
			global $wp_filesystem;
			// $json = json_encode($arr);
			$json = $arr;
			$json = $wp_filesystem->put_contents(GS_USER_CONFIG_PATH,$json);
		}
	}
	public function curlJson($token = null, $params = array() ) {
		if($token==null) return false;
		$query = ( count( $params ) > 0 ) ? '?' . http_build_query( $params ) : '';
		$url = GS_API_ITEMS_URL . $query;
		$headers = array(
			'Content-type: application/json; charset=UTF-8',
			'Accept: application/json',
			'Authorization: Bearer '. $token
		);
		if (!function_exists('curl_version')) return false;

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		$data = curl_exec( $ch );
		$response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		if ( $response === 200 ) {
			$data = json_decode( $data, true );
		} else {
			$data = false;
		};

		return $data;
	}
	public function loginAuthGS(){
		$arr = $this->getUserConfig();
		$mail = $arr['userdata']['mail'];
		$pass = $arr['userdata']['pass'];
		if (!function_exists('curl_version')) return false;
		$result = $this->GScurl($mail, $pass);

		if($result=='Unauthorized' || $result==false || $result==null){
			return false;
		}else{
			$json = json_decode($result,true);
			$token = $json['user']['token'];
			return $token;
		}
	}
	public function authGS($mail, $pass){
		if (!function_exists('curl_version')) return false;
		$result = $this->GScurl($mail, $pass);

		if($result=='Unauthorized' || $result==false || $result==null){
			return false;
		}else{
			$json = json_decode($result,true);
			$token = $json['user']['token'];
			// return $token;
			return true;
		}
	}
	public function getToken(){
		$arr = $this->getUserConfig();
		$mail = $arr['userdata']['mail'];
		$pass = $arr['userdata']['pass'];
		if (!function_exists('curl_version')) return false;
		$result = $this->GScurl($mail, $pass);

		if($result=='Unauthorized' || $result==false || $result==null){
			return false;
		}else{
			$token = $json['user']['token'];
			return $token;
		}
	}
	private function GScurl($mail, $pass){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,GS_API_TOKEN_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$mail:$pass");
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	public function methodStr($num){
		$methods = openssl_get_cipher_methods();
		return $method[$num];
	}
	public function methodsCount(){
		return count(openssl_get_cipher_methods());
	}
	public function encryptStr($data){
		return $this->encrypt(GS_ALGO_PATTERN, GS_ALGO_KEY, $data);
	}
	public function decryptStr($data){
		return $this->decrypt(GS_ALGO_PATTERN, GS_ALGO_KEY, $data);
	}
	// 暗号化
	private function encrypt($algo, $key, $data){
		$iv_size = openssl_cipher_iv_length($algo);
		$iv = $this->getRandomString($iv_size);
		$encrypted = openssl_encrypt($data, $algo, $key, OPENSSL_RAW_DATA, $iv);
		return $iv . $encrypted;
	}
	// 復号化
	private function decrypt($algo, $key, $encrypted){
		$iv_size = openssl_cipher_iv_length($algo);
		$iv = substr($encrypted, 0,$iv_size);
		$encrypted_data = substr($encrypted, $iv_size);
		$desrpted = openssl_decrypt($encrypted_data, $algo, $key, OPENSSL_RAW_DATA, $iv);
		return $desrpted;
	}
	private function getRandomString($length){
		$chars = implode('', array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9')));
		$str = '';
		for ($i = 0; $i < $length; ++$i) {
			$str .= $chars[mt_rand(0, 61)];
		}
		return $str;
	}
	public function entryPOST($post){
		if(!isset($post['email']) || !isset($post['password'])) $this->errorMessage = "メールアドレスの形式に誤りがあります。ご確認ください。";
        if(!isset($post['email'])) return false;
        if(!isset($post['password'])) return false;
        if(isset($post['entry'])){
            if(is_email($post['email'])){
                if($this->entryUserInfo($post)){
                	$this->errorMessage = '登録・更新完了しました。';
                	return true;
                }else{
                	$this->errorMessage = "認証エラーが発生しました。メールアドレス・パスワードをご確認ください。";
                	return false;
                }
            }else{
            	$this->errorMessage = "メールアドレスの形式に誤りがあります。ご確認ください。";
            }
        }else{
        	$this->errorMessage = "不正値を検出しました。再度、ご入力してください。";
        }
        return false;
    }
    public function entryUserInfo($post){
        $status = $this -> authGS($post['email'], $post['password']);
        if(!$status) return false;  // メール・パスワード認証（unauthorizedの場合 falseを返す）
        require_once(ABSPATH.'wp-includes/pluggable.php');
        $randNum = wp_rand(0, $this -> methodsCount());
        $mail = $post['email'];
        $pass = $post['password'];

        $arr = array('userdata' => ['mail' => $mail, 'pass' => $pass, 'method' => $randNum]);
        $json = json_encode($arr);
        $encArr = $this -> encryptStr($json);
        $this -> putUserConfig($encArr);

        return true;
    }
}
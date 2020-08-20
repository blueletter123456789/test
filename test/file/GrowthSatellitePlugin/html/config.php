<?php
	global $GScomm;
	$comm = $GScomm;
	$url = $comm -> nowuri();

	$post = $_POST;
	$user_email = '';
	$user_pass = '';
	$message = $comm->errorMessage;
	$submitText = "登録する";
	$initMessage = ($_GET['page']==GS_MAIN_PATH) ? "※初期登録を行ってください。" : "";

	// 既に登録済みの場合
	if($comm -> getUserConfig()){
		$submitText = "更新する";
		$arr = $comm -> getUserConfig();
		$data = $arr['userdata'];
		$user_email = (!empty($data['mail'])) ? $data['mail'] : '' ;
		$user_pass = (!empty($data['pass'])) ? $data['pass'] : '' ;
	}

?>

<h1>Growth Satellite WordPress ログイン設定</h1>
<p>Growth Satelliteに登録された、メールアドレス・パスワードをご入力ください。</p>
<?php
	if($initMessage!=""){
		echo '<h2 class="init_message alert">' . $initMessage . '</h2>';
	}
?>
<div>
	<form id="entry_form" action="<?php echo $url; ?>" method="post" autocomplete="off">
		<?php
		if($message!=''){
			echo '<h2 class="alert">' . $message . '</h2>';
		}
		?>
		<div>
			<div>
				<label for="email">メールアドレス</label>
				<span>
					<input id="email" type="email" name="email" placeholder="login@mail.com" value="<?php echo $user_email; ?>" required>
				</span>
			</div>
			<div>
				<label for="password">パスワード</label>
				<span>
					<input id="password" type="password" name="password" placeholder="passwords" value="<?php echo $user_pass; ?>" required>
					<label class="icon show" for="passshow"></label>
				</span>
			</div>
			<div>
				<label id="entry_btn" for="entry"><?php echo $submitText; ?></label>
				<input id="entry" type="submit" name="entry" value="entry">
			</div>
		</div>
	</form>
	<input id="passshow" type="checkbox" name="passshow" value="1">
</div>
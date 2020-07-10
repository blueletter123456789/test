<?php

	if(isset($_POST['button']) == true) {
	    $formDisplay = 2;

	    require_once('./common.php');
	    $post = sanitize($_POST);

	    $firstName = $post['firstname'];
	    $lastName = $post['lastname'];
	    $email = $post['mail'];
	    $tel = $post['phone'];
	    $subject = $post['subject'];
	    $message = $post['message'];
	}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Complete send mail</title>
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="stylesheet" href="../css/mail_done.css" />
    <link rel="shortcut icon" href="../css/img/favicon.ico" type="image/svg+xml"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />
    <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" integrity="sha384-ujbKXb9V3HdK7jcWL6kHL1c+2Lj4MR4Gkjl7UtwpSHg/ClpViddK9TI7yU53frPN" crossorigin="anonymous"></script>
</head>
<body>
	<section id="contact" class="page contact">
        <div class="form-title">
          <h1 id="contact-title">Complete send Message</h1>
        </div>
		<div id="form-wrapper">
		    <div id="form-inside">
		    	<h2 class="msg-title">お問い合わせありがとうございます。</h2>
		    	<p class="msg-text">ご記入いただいた情報の送信が完了しました。</p>
		    	<p class="msg-text">確認のため、お客様に自動送信しております。</p>
		    	<div class="msg-link">
		    		<ul>
		    			<li class="link-wrapper"><a href="../index.php">トップページへ戻る</a></li>
		    			<li class="link-wrapper"><a href="../html/service.html">サービスを見る</a></li>
		    			<li class="link-wrapper"><a href="../html/work.html">作品を見る</a></li>
		    			<li class="link-wrapper"><a href="https://riding.co.jp/portfolio/ShuheiAbe/blog/">ブログを見る</a></li>
		    		</ul>
                  	<a href="./test_cache_clear.php">キャッシュクリア</a>
		    	</div>
		    </div>
		</div>
    </section>	
</body>
</html>
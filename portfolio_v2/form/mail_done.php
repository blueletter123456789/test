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

	// send mail to customer
	$honbunToCustomer = '';
	$honbunToCustomer .= $lastName.$firstName."様\n";
	$honbunToCustomer .= "\n";
	$honbunToCustomer .= "ご連絡ありがとうございます。\n";
	$honbunToCustomer .= "阿部　周平です。\n";
	$honbunToCustomer .= "\n";
	$honbunToCustomer .= "お客様が送信されましたメールを受け付けましたため、\n";
	$honbunToCustomer .= "ご連絡いたしました。\n";
	$honbunToCustomer .= "\n";
	$honbunToCustomer .= "３営業日以内に折り返しご連絡いたします。\n";
	$honbunToCustomer .= "今後ともよろしくお願いいたします。\n";
	$honbunToCustomer .= "\n";	
	$honbunToCustomer .= "問い合わせフォームより以下の内容で送信しております。\n";
	$honbunToCustomer .= "\n";	
	$honbunToCustomer .= "お名前：".$lastName.$firstName."\n";
	$honbunToCustomer .= "E-mail：".$email."\n";
	$honbunToCustomer .= "電話番号：".$tel."\n";
	$honbunToCustomer .= "件名：".$subject."\n";
	$honbunToCustomer .= "本文：".$message."\n";
	$honbunToCustomer .= "\n\n";
	$honbunToCustomer .= "※本メールはサーバーからの自動返信メールとなっております。\n";
	$honbunToCustomer .= "本メールに返信いただいてもご連絡いたしかねますのでご了承ください。\n";
	$honbunToCustomer .= "----------------------------------\n";
	$honbunToCustomer .= "阿部　周平\n";
	$honbunToCustomer .= "Mail:blackletter123456789@gmail.com\n";
	$honbunToCustomer .= "Tell:080-2712-2816\n";
	$honbunToCustomer .= "----------------------------------\n";

/*
	print '<br>';
	print nl2br($honbunToCustomer);
	exit();
*/
	$titleToCustomer = 'ご連絡ありがとうございます。';
	$headerToCustomer = 'FROM:blackletter123456789@gmail.com';
	$honbunToCustomer = html_entity_decode($honbunToCustomer, ENT_QUOTES, 'UTF-8');
	mb_language('Japanese');
	mb_internal_encoding('UTF-8');
	mb_send_mail($email, $titleToCustomer, $honbunToCustomer, $headerToCustomer);


	// send mail to me
	$honbunToMe = '';
	$honbunToMe = $lastName.$firstName."様からご連絡がありました。";
	$honbunToMe = "\n";
	$honbunToMe .= "依頼者名：".$lastName.$firstName."\n";
	$honbunToMe .= "E-mail：".$email."\n";
	$honbunToMe .= "電話番号：".$tel."\n";
	$honbunToMe .= "件名：".$subject."\n";
	$honbunToMe .= "問い合わせ内容：".$message."\n";
	$honbunToMe .= "\n\n";

	$titleToMe = 'ポートフォリオサイトよりお客様からのご連絡';
	$headerTocustomer = 'FROM:'.$email;
	$honbunToCustomer = html_entity_decode($honbunToCustomer, ENT_QUOTES, 'UTF-8');
	mb_language('Japanese');
	mb_internal_encoding('UTF-8');
	mb_send_mail('blackletter123456789@gmail.com', $titleToMe, $honbunToMe, $headerToMe);
/*
	print '<br>';
	print nl2br($honbunToMe);
	exit();
*/

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
		    	<p class="msg-text">ご確認のため、お客様に自動送信しております。</p>
		    	<div class="msg-link">
		    		<ul>
		    			<li class="link-wrapper"><a href="../index.php">トップページへ戻る</a></li>
		    			<li class="link-wrapper"><a href="../html/service.html">サービスを見る</a></li>
		    			<li class="link-wrapper"><a href="../html/work.html">作品を見る</a></li>
		    			<li class="link-wrapper"><a href="https://riding.co.jp/portfolio/ShuheiAbe/blog/">ブログを見る</a></li>
		    		</ul>
		    	</div>
		    </div>
		</div>
    </section>	
</body>
</html>
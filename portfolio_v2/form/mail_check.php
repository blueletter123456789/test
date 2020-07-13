<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Mail confirm</title>
	    <link rel="stylesheet" href="../css/common.css" />
	    <link rel="stylesheet" href="../css/mail_check.css" />
	    <link rel="shortcut icon" href="../css/img/favicon.ico" type="image/svg+xml"/>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />
	    <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" integrity="sha384-ujbKXb9V3HdK7jcWL6kHL1c+2Lj4MR4Gkjl7UtwpSHg/ClpViddK9TI7yU53frPN" crossorigin="anonymous"></script>
	</head>
	<body>
<?php

	// initial section
	require_once('./common.php');

	$post = sanitize($_POST);

	$firstName = $post['firstname'];
	$lastName = $post['lastname'];
	$email = $post['mail'];
	$tel = $post['phone'];
	$subject = $post['subject'];
	$message = $post['message'];

	// validation section
	$allCheckFlg = true;
	$ngCheckFlg1 = false;
	$ngCheckFlg2 = false;
	$ngCheckFlg3 = false;
	$ngCheckFlg4 = false;
	$ngCheckFlg5 = false;
	$ngCheckFlg7 = false;

	if ($firstName == '') {
		$allCheckFlg = false;
		$ngCheckFlg1 = true;
	}elseif (preg_match('/[^ぁ-んァ-ン一-龥a-zA-Z]/', $firstName) != 0) {
		$allCheckFlg = false;
		$ngCheckFlg2 = true;
	}

	if ($lastName == '') {
		$allCheckFlg = false;
		$ngCheckFlg3 = true;
	}elseif (preg_match('/[^ぁ-んァ-ン一-龥a-zA-Z]/', $lastName) != 0) {
		$allCheckFlg = false;
		$ngCheckFlg4 = true;
	}

	if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0) {
		$allCheckFlg = false;
		$ngCheckFlg5 = true;
	}

/*	if ((filter_var($email, FILTER_VALIDATE_EMAIL)) == false) {
		$allCheckFlg = false;
		$ngCheckFlg6 = true;
	}
*/
	if (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel)==0) {
		$allCheckFlg = false;
		$ngCheckFlg7 = true;
	}

?>

    <section id="contact" class="page contact">
        <div class="form-title">
          <h1 id="contact-title">Do you send this message？</h1>
        </div>
		<div id="form-wrapper">
		    <div id="form-inside">
		      <div class="name-record">
		        <p class="input-record" id="input-firstname">
		          <span class="form-tag">First Name</span>
		          <?php if ($ngCheckFlg1 == true) {
		          	print '<span class="form-msg">名を入力してください</span>';
		          }elseif ($ngCheckFlg2 == true) {
		          	print '<span class="form-msg">名を正しく入力してください</span>';
		          } ?>
		          <span class="input-val"><?php print $firstName; ?></span>
		        </p>
		        <p class="input-record" id="input-lastname">
		          <span class="form-tag">Last Name</span>
		          <?php if ($ngCheckFlg3 == true) {
		          	print '<span class="form-msg">姓を入力してください</span>';
		          }elseif ($ngCheckFlg4 == true) {
		          	print '<span class="form-msg">姓を正しく入力してください</span>';
		          } ?>
		          <span class="input-val"><?php print $lastName; ?></span>
		        </p>
		      </div>
		      <p class="input-record" id="input-mail">
		        <span class="form-tag">Mail</span>
		        <?php if ($ngCheckFlg5 == true) {
		        	print '<span class="form-msg">メールアドレスを正しく入力してください</span>';
		        } ?>
		        <span class="input-val"><?php print $email; ?></span>
		      </p>
		      <p class="input-record" id="input-phone">
		        <span class="form-tag">Phone</span>
		        <?php if ($ngCheckFlg7 == true) {
		        	print '<span class="form-msg">電話番号を正しく入力してください</span>';
		        } ?>
		        <span class="input-val"><?php print $tel; ?></span>
		      </p>
		      <p class="input-record" id="input-subject">
		        <span class="form-tag">Subject</span>
		        <?php ?>
		        <span class="input-val"><?php print $subject; ?></span>
		      </p>
		      <p class="input-record" id="input-message">
		        <span class="form-tag">Message</span>
		        <?php ?>
		        <span class="input-val"><?php print $message; ?></span>
		      </p>
				<form method="post" action="./mail_done.php">
					<input type="hidden" name="firstname" value="<?php print $firstName; ?>">
					<input type="hidden" name="lastname" value="<?php print $lastName; ?>">
					<input type="hidden" name="mail" value="<?php print $email; ?>">
					<input type="hidden" name="phone" value="<?php print $tel; ?>">
					<input type="hidden" name="subject" value="<?php print $subject; ?>">
					<input type="hidden" name="message" value="<?php print $message; ?>">
				      <p class="button-record">
				        <span id="return-button">
					        <input type="button" onclick="history.back()" value="Back">
				        </span>
				      	<?php if ($allCheckFlg == true) { ?>
				        <span id="button-wrapper">
				          <i
				            class="fas fa-caret-right faa-flash animated button-icon"
				            data-fa-transform="grow-8"
				          ></i>
				          <input type="submit" name='button' value="Send by Mail" />
				        </span>
				    <?php } ?>
				      </p>
				</form>
		    </div>
		</div>
	</section>	
</body>
</html>	

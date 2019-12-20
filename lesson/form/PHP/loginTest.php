<?php

	// var_dump($_POST);

	// リダイレクト
	if (!isset($_POST['button'])){
		header('location:http://localhost/github/lesson/form/index.html');
		exit();
	}

	// NULLチェック
	if (empty($_POST['name']) || empty($_POST['pass'])){
		header('location:http://localhost/github/lesson/form/index.html');
		exit();
	}

	$post = $_POST;

	$name = $post['name'];


	// DBの名前

	require_once dirname(__FILE__). '/dbConnect.php';

	// var_dump('chk');

	$db = new dbConnect();

	$pdo = $db -> connect();

	$statement = $pdo -> query('SELECT * FROM login_tbl');

	$query = 'SELECT * FROM login_tbl WHERE NAME = :name';
	$stmt = $pdo -> prepare($query);
	
	$stmt -> bindParam(':name', $name);
	$stmt -> execute();
	// $stmt->execute(array(':name' => '阿部周平'));

	// var_dump($statement);

	// $row = $statement -> fetchAll(PDO::FETCH_ASSOC);

	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	// var_dump(PDO::FETCH_ASSOC);
	// var_dump($row);


	if (empty($row)){
		echo "空";
	}else if($post['pass'] == $row["PASS"]){
		echo "OK";
	}else{
		echo "NG";
	}


?>
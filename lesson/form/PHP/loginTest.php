<?php

	var_dump($_POST);





	// DBの名前

	require_once dirname(__FILE__). '/dbConnect.php';

	// var_dump('chk');

	$db = new dbConnect();

	$pdo = $db -> connect();

	$statement = $pdo -> query('SELECT * FROM login_tbl');

	$query = 'SELECT * FROM login_tbl WHERE NAME = :name';
	$stmt = $pdo -> prepare($query);
	
	$name = '久保田貴也';
	$stmt -> bindParam(':name', $name);
	$stmt -> execute();
	// $stmt->execute(array(':name' => '阿部周平'));

	// var_dump($statement);

	// $row = $statement -> fetchAll(PDO::FETCH_ASSOC);

	$row = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	// var_dump(PDO::FETCH_ASSOC);
	var_dump($row);


?>
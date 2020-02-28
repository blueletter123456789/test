<?php

	// DBの名前をpdoより取得
	require_once './dbConnect.php';

	$db = new dbConnect();

	$pdo = $db -> connect();

	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// $useTable = 'TBL_INPUT';

	// $statement = 'SELECT * FROM `:tbl` ';

	// $stmt = $pdo -> prepare($statement);

	// $stmt -> bindValue(':tbl', $useTable);

	// $stmt -> execute();

	$stmt = $pdo -> query('SELECT i.input_code as "input_code", i.input_date as "input_date", u.use_name as "use_name", d.account_name as account_name, i.amount as "amount" FROM TBL_INPUT i INNER JOIN TBL_USE u on i.use_code = u.use_code INNER JOIN TBL_ACCOUNT_DETAIL d on i.account_code = d.account_code WHERE u.use_flg = "0" AND d.account_flg = "0"');

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($row, JSON_UNESCAPED_UNICODE);

    echo $json;


?>
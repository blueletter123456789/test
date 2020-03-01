<?php

	$phpPath = dirname(__FILE__);

	$tbl_var = 0;

	$date = date("Y-m-d");

	$startDate = $date;
	$endtDate = $date;
	$use_code = 1;
	$account_code = 1;
	$tblNames = ['inputData', 'outputData', 'journalData', 'budgetData'];


	// テスト用
	$startDate = '2020-02-01';


	// DBの名前をpdoより取得
	require_once ($phpPath."/dbConnect.php");
	require_once ($phpPath."/queryList.php");


	$db = new dbConnect();

	$pdo = $db -> connect();

	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$queryList = new queryList();

	switch($tbl_var){
		case 0:
			$statement = $queryList -> getAllQuery($startDate , $endtDate, $use_code, $account_code);
			foreach ($statement as $key => $value) {
				$stmtAll[] = $pdo -> query($value);
			}
			break;

		case 1:
			$stmt = $pdo -> query($queryList -> getInputQuery());
			break;
		
		case 2:
			$stmt = $pdo -> query($queryList -> getOutputQuery());
			break;

		case 3: 
			$stmt = $pdo -> query($queryList -> getJournalQuery($startDate , $endtDate, $use_code, $account_code));
			break;

		case 4: 
			$stmt = $pdo -> query($queryList -> getBudgetQuery());
			break; 

		default: 
			break;
	}


	foreach ($stmtAll as $key => $value) {
		$row[] = $value->fetchAll(PDO::FETCH_ASSOC);
	}

	$row = array_combine($tblNames, $row);

    $json = json_encode($row, JSON_UNESCAPED_UNICODE);

    echo $json;


?>
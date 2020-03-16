<?php

	$phpPath = dirname(__FILE__);

	$tbl_var = 0;

	$date = date("Y-m-d");

	$startDate = $date;
	$endtDate = $date;
	$use_code = '1';
	$account_code = '1';
	$tblNames = ['inputData', 'outputData', 'journalData', 'budgetData', 'balanceData', 'accountInputData', 'accountOutputData', 'useInputData' , 'useOutputData', 'bsTotalData'];


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

		case 5: 
			$stmt = $pdo -> query($queryList -> getBalanceQuery());
			break;

		case 6:	
			break;

		default: 
			break;
	}


	if($tbl_var == 0){
		foreach ($stmtAll as $key => $value) {
			$row[] = $value->fetchAll(PDO::FETCH_ASSOC);
		}
		$row = array_combine($tblNames, $row);
	}else{
		if ($tbl_var !== 6 && $tbl_var !== 7) {
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$tblName = $tblNames[$tbl_var - 1];
			$row = array($tblName => $row);
		}

	}

	switch ($tbl_var) {
		case 0:
			$row = calcBalance($row);
			$bsrow = getBsAllData($pdo, $queryList);
			$row = array_merge($row, $bsrow);
			$row = calcBs($row);
			break;
		case 5:
			$row = calcBalance($row);
			break;
		case 6: 
			$row = getBsAllData($pdo, $queryList); 
			$row = calcBs($row);
			break;
		case 7: 
			break;
		default:
			break;
	}


    $json = json_encode($row, JSON_UNESCAPED_UNICODE);

    echo $json;


    // ************ 集計関数 ************

    function calcBalance($tblData){

		$balanceData = $tblData['balanceData'];

    	foreach ($balanceData as $key => $data) {

    		if ($data['account_flg'] == 0) {
    			$inputBalance = intval($data['budgetAmount']) - intval($data['inputAmount']);
    			$outputBalance = "0";
    		}else{
    			$outputBalance = intval($data['budgetAmount']) - intval($data['outputAmount']);
    			$inputBalance = "0";    			
    		}
    		$balanceData[$key] = array_merge($balanceData[$key],array('inputBalance'=> strval($inputBalance)));
    		$balanceData[$key] = array_merge($balanceData[$key],array('outputBalance'=> strval($outputBalance)));
    	}

    	$tblData['balanceData'] = $balanceData;
    	return $tblData;

    }


    // ************ 貸借対照表（資産）データ加工関数 ************

    function getBsAllData($pdo, $queryList){

    	$bsTblNames = ['bsInputData', 'bsOutputData', 'bsAssetData'];

		$bsStatement = $queryList -> getBsAllQuery();
		foreach ($bsStatement as $key => $value) {
			$stmtbsAll[] = $pdo -> query($value);
		}

		foreach ($stmtbsAll as $key => $value) {
			$bsrow[] = $value->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
		}

		$bsrow = array_combine($bsTblNames, $bsrow);

    	return $bsrow;

    }

    function calcBs($tblData){

    	$bsData = 0;

    	for ($i=1; $i <= 2; $i++) { 
	    	$bsData += intval($tblData['bsTotalData'][$i]['amount']);
    	}

    	$bsTotal = [ 'amount' => strval($bsData), 
    				 'asset_name' => '負債・純資産の部'
    				];

    	array_push($tblData['bsTotalData'], $bsTotal);

    	return $tblData;

    }


?>
<?php

	$phpPath = dirname(__FILE__);

	$tbl_var = 0;

	$date = date("Y-m-d"); 
	$month = date("Y-m");
	$startDate = $date;
	$endtDate = $date;
	$use_code = '1';
	$account_code = '1';
	
	$tblNames = ['inputData', 'outputData', 'journalData', 'budgetData', 'balanceData', 'plMonthData', 'accountInputData', 'accountOutputData', 'useInputData' , 'useOutputData'];


	// テスト用
	$startDate = '2020-02-01';
	$month = '2020-03';

	if (isset($_GET['displayButton'])){
		$getData = $_GET;
		$startDate = $getDate['startDate'];
		$endtDate = $getDate['endDate'];
		$use_code = $getDate['use_code'];
		$account_code = $getDate['account_code']; 
	}

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
			$statement = $queryList -> getAllQuery($startDate , $endtDate, $use_code, $account_code, $month, $date);
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
			var_dump($stmt);
			exit();
			break;

		case 4: 
			$stmt = $pdo -> query($queryList -> getBudgetQuery());
			break; 

		case 5: 
			$stmt = $pdo -> query($queryList -> getBalanceQuery());
			break;

		case 6: 
			$stmt = $pdo -> query($queryList -> getPlQuery($month));
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
		if ($tbl_var !== 7) {
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$tblName = $tblNames[$tbl_var - 1];
			$row = array($tblName => $row);
		}

	}

	switch ($tbl_var) {
		case 0:
			$row = calcBalance($row);
			$bsrow = getBsAllData($pdo, $queryList, $month);
			$row = array_merge($row, $bsrow);
			$row = calcBs($row);
			$row = getPlTitle($row);
			break;
		case 5:
			$row = calcBalance($row);
			break;
		case 6: 
			$row = getPlTitle($row);
			break;
		case 7: 
			$row = getBsAllData($pdo, $queryList, $month); 
			$row = calcBs($row);
			break;
		default:
			break;
	}


    $json = json_encode($row, JSON_UNESCAPED_UNICODE);

    echo $json;

	if (isset($_GET['displayButton'])){
	    header('location:http://localhost/github/app/pl/index.html');
	}

    exit;

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

    function getBsAllData($pdo, $queryList, $month){

    	$bsTblNames = ['bsInputData', 'bsOutputData', 'bsAssetData', 'bsTotalData'];

		$bsStatement = $queryList -> getBsAllQuery($month);
		foreach ($bsStatement as $key => $value) {
			$stmtbsAll[] = $pdo -> query($value);
		}

		foreach ($stmtbsAll as $key => $value) {
			$bsrow[] = $value->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
		}
		
		$stmt = $pdo -> query($queryList -> getBsTotalQuery($month));
		$bsrow[] = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    function getPlTitle($tblData){

    	$plName = ['売上高', '売上原価', '売上総利益', '販売費及び一般管理費', '営業利益', '営業外収益', '営業外費用', '経常利益', '特別利益', '特別損失', '税引前登記純利益', '当期純利益'];

    	$plData = $tblData['plMonthData'];
    	
    	$plData = array_combine($plName, $plData[0]);

    	$tblData['plMonthData'] = $plData;

    	return $tblData;
    }


?>
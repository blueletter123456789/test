<?php


	$phpPath = dirname(__FILE__);

	// DB接続
	require_once ($phpPath."/dbConnect.php");

	$db = new dbConnect();

	$pdo = $db -> connect();

	$flg = 0;


	// PHPからのデータ受け取り

	if (!isset($_POST['registButton'])){
		header('location:http://localhost/github/app/pl/index.html');
		exit();
	}

	$post = $_POST;

	$tblName = $post['tbl_name'];

	foreach ($post as $key => $value) {
		if (empty($value)) {
			header('location:http://localhost/github/app/pl/index.html');
			exit();
		}

		if(preg_match("/date$/", $key)){
			if ($tblName == 'TBL_BUDGET') {
				$colValue = '"'.$value .'-01"';
			}else{
				$colValue = '"'.$value .'"';
			}
		}elseif ($key !== 'registButton' && $key !== 'tbl_name') {
			$colValue .= ', ' .$value;
		}

	}

	$colName = implode( ', ', array_slice(array_keys($post), 0, 4));

	if ($tblName == 'TBL_BUDGET') {

		$flg = getBudgetData($pdo, $phpPath, $post);

		intval($post['account_code']) <= 28 ? $colValue .= ', 0' : $colValue .= ', 1';

		$colName .= ', budget_flg';

	}


	// SQL実行
	$sql = <<<SQL
INSERT INTO $tblName ($colName) 
VALUES ($colValue)
SQL;


	try {
		if ($flg == 0) {
			$stmt = $pdo->prepare($sql);
			$result = $stmt->execute();
		    if (!$result) {
		        throw new Exception ("execute_false");
		    }
		}
	} catch (Exception $e) {
	    var_dump($e->getMessage());
	}


	// jsonデータ出力部分
	if ($tblName == 'TBL_INPUT' || $tblName == 'TBL_OUTPUT') {
	
		require_once($phpPath."/calc_pl.php");
	
		if ($tblName == 'TBL_INPUT') {
			$date = $post['input_date'];
		}else{
			$date = $post['output_date'];
		}

		$date = date('Y-m', strtotime($date));
		$year = date('Y', strtotime($date));
		$month = date('m', strtotime($date));

		$calc = new calc_pl();

		$calc->writeData($date, $year, $month);

	}


	if (isset($_POST['registButton'])){
	    header('location:http://localhost/github/app/pl/index.html');
	}





	// 予算データ取得関数
	function getBudgetData($pdo, $phpPath, $post){

		$flg = 0;

		require_once ($phpPath."/queryList.php");

		$queryList = new queryList();

		$stmt = $pdo -> query($queryList -> getBudgetQuery());
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$baseMonth = date("Y-m");

		$account_code = $post['account_code'];
		$month = $post['budget_date'];

		foreach ($row as $key => $value) {
			if ($value['account_code'] == $account_code && $value['budget_date'] == $month) {
				$flg = 1;
			}
		}

		return $flg;

	}






?>
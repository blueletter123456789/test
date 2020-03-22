<?php


	$phpPath = dirname(__FILE__);

	// DB接続
	require_once ($phpPath."/dbConnect.php");

	$db = new dbConnect();

	$pdo = $db -> connect();


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
			$colValue = '"'.$value .'"';
		}elseif ($key !== 'registButton' && $key !== 'tbl_name') {
			$colValue .= ', ' .$value;
		}

	}

	$colName = implode( ', ', array_slice(array_keys($post), 0, 4));

	if ($tblName == 'TBL_BUDGET') {

		getBudgetData($pdo, $phpPath, $post);

		intval($post['account_code']) <= 28 ? $colValue .= ', 0' : $colValue .= ', 1';

		$colName .= ', budget_flg';

	}


	// SQL実行
	$sql = <<<SQL
INSERT INTO $tblName ($colName) 
VALUES ($colValue)
SQL;


var_dump($sql);
	echo "<br>";
var_dump($colValue);
exit();


	try {
		$stmt = $pdo->prepare($sql);

		$result = $stmt->execute();

	    if (!$result) {
	        throw new Exception ("execute_false");
	    }
	} catch (Exception $e) {
	    var_dump($e->getMessage());
	}








	// 予算データ取得関数
	function getBudgetData($pdo, $phpPath, $post){

		require_once ($phpPath."/queryList.php");

		$queryList = new queryList();

		$stmt = $pdo -> query($queryList -> getBudgetQuery());
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$account_code = $post['account_code'];

		foreach ($row as $k => $v) {
			foreach ($v as $key => $value) {
				if ($key == 'account_code') {
					if ($value == $account_code) {
						var_dump('error');
					}
				}
			}
		}

		var_dump($row);
		echo "<br>";
		var_dump($post);
		exit();

	}






?>
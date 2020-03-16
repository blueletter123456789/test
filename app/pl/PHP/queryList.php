<?php

/**
 * 
 */
class queryList
{
	
 //    var_dump($date);


	function __construct()
	{


	}

	public function getAllQuery($startDate, $endDate, $use, $account){
		$statement = [
			self::getInputquery(), 
			self::getOutputquery(), 
			self::getJournalQuery($startDate, $endDate, $use, $account), 
			self::getBudgetquery(), 
			self::getBalanceQuery(), 
			self::getAccountInput(), 
			self::getAccountOutput(), 
			self::getUseInput(), 
			self::getUseOutput(), 
			self::getBsTotalQuery() 
		];
		return $statement;
	}

	public function getBsAllQuery(){
		$statement = [
			self::getBsInputQuery(), 
			self::getBsOutputQuery(), 
			self::getBsAssetQuery()
		];
		return $statement;
	}


	// 勘定科目（入力）取得SQL
	public function getAccountInput(){

		$statement = <<<SQL
SELECT ad.account_name, a.account_category_name, ad.account_flg 
FROM TBL_ACCOUNT_DETAIL ad 
INNER JOIN TBL_ACCOUNT_CATEGORY a 
ON ad.account_category_code = a.account_category_code 
WHERE account_flg = "0"
SQL;
	return $statement;

	}


	// 勘定科目（出力）取得SQL
	public function getAccountOutput(){

		$statement = <<<SQL
SELECT ad.account_name, a.account_category_name, ad.account_flg 
FROM TBL_ACCOUNT_DETAIL ad 
INNER JOIN TBL_ACCOUNT_CATEGORY a 
ON ad.account_category_code = a.account_category_code 
WHERE account_flg = "1"
SQL;
	return $statement;

	}


	// 用途（入力）取得SQL
	public function getUseInput(){

		$statement = <<<SQL
SELECT use_name, use_flg 
FROM TBL_USE 
WHERE use_flg = "0"
SQL;
	return $statement;

	}


	// 用途（出力）取得SQL
	public function getUseOutput(){
		$statement = <<<SQL
SELECT use_name, use_flg 
FROM TBL_USE 
WHERE use_flg = "1"
SQL;
	return $statement;

	}


	// 貸方取得SQL
	public function getInputQuery(){

		$statement = <<<SQL
SELECT i.input_code as 'input_code', i.input_date as 'input_date', u.use_name as 'use_name', d.account_name as account_name, i.amount as 'amount' 
FROM TBL_INPUT i 
INNER JOIN TBL_USE u on i.use_code = u.use_code 
INNER JOIN TBL_ACCOUNT_DETAIL d on i.account_code = d.account_code 
WHERE u.use_flg = '0' 
AND d.account_flg = '0'
SQL;

		return $statement;

	}


	// 借方取得SQL
	public function getOutputQuery(){

		$statement = <<<SQL
SELECT o.output_code as 'output_code', o.output_date as 'output_date', u.use_name as 'use_name', d.account_name as 'account_name', o.amount as 'amount' 
FROM TBL_OUTPUT o 
INNER JOIN TBL_USE u on o.use_code = u.use_code 
INNER JOIN TBL_ACCOUNT_DETAIL d on o.account_code = d.account_code 
WHERE u.use_flg = '1' 
AND d.account_flg = '1'
SQL;

			return $statement;
	}


	// 仕訳帳取得SQL
	public function getJournalQuery($startDate, $endDate, $use, $account){

		$statement = <<<SQL
SELECT i.input_date as 'date', u.use_name as 'use_name', d.account_name as 'account_name', i.amount as 'amount' 
FROM TBL_INPUT i 
INNER JOIN TBL_USE u 
ON i.use_code = u.use_code 
INNER JOIN TBL_ACCOUNT_DETAIL as d 
ON i.account_code = d.account_code 
WHERE i.input_date BETWEEN '$startDate'  AND '$endDate' 
AND i.use_code = '$use' 
AND i.account_code = '$account' 
UNION 
SELECT o.output_date as 'date', u.use_name as 'use_name', d.account_name as 'account_name', o.amount as 'amount' 
FROM TBL_OUTPUT o 
INNER JOIN TBL_USE u 
ON o.use_code = u.use_code 
INNER JOIN TBL_ACCOUNT_DETAIL as d 
ON o.account_code = d.account_code 
WHERE o.output_date BETWEEN '$startDate' AND '$endDate' 
AND o.use_code = '$use' 
AND o.account_code = '$account'
SQL;

			return $statement;

	}


	// 予算取得SQL
	public function getBudgetQuery(){

		$statement = <<<SQL
SELECT u.use_name, d.account_name, b.amount 
FROM TBL_BUDGET b 
INNER JOIN TBL_USE u 
on b.use_code = u.use_code 
INNER JOIN TBL_ACCOUNT_DETAIL d 
on b.account_code = d.account_code 
WHERE DATE_FORMAT(b.budget_month, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')
SQL;

		return $statement;
	}


	// 残高取得SQL
	public function getBalanceQuery(){

		$statement = <<<SQL
SELECT IFNULL(input,0) as 'inputAmount', account_name as 'accountName', IFNULL(output, 0) as 'outputAmount' ,IFNULL(budget, 0) as 'budgetAmount' ,ad.account_flg
FROM TBL_ACCOUNT_DETAIL as ad 
LEFT JOIN 
(SELECT account_code, SUM(amount) as 'budget' FROM TBL_BUDGET WHERE budget_month >= '2020-01-01' GROUP BY account_code) as b 
ON ad.account_code = b.account_code 
LEFT JOIN
(SELECT account_code,  SUM(amount) as 'input' FROM TBL_INPUT WHERE input_date >= '2020-01-01' GROUP BY account_code) as i
ON ad.account_code = i.account_code 
LEFT JOIN 
(SELECT account_code ,SUM(amount) as 'output' FROM TBL_OUTPUT WHERE output_date >= '2020-01-01' GROUP BY account_code) as o
ON ad.account_code = o.account_code 
WHERE input <> '0' 
OR output <> '0'
ORDER BY ad.account_code
SQL;

		return $statement;
	}


	// 勘定科目タイトル（貸方）取得SQL
	public function getBsTitleInput(){

		$statement = <<<SQL
SELECT * 
FROM TBL_ACCOUNT_CATEGORY
WHERE account_category_flg = '0'
SQL;

	return $statement;

	}


	// 勘定科目タイトル（借方）取得SQL
	public function getBsTitleOutput(){

		$statement = <<<SQL
SELECT * 
FROM TBL_ACCOUNT_CATEGORY
WHERE account_category_flg = '1'
SQL;

	return $statement;

	}


	// 貸借対照表貸方取得SQL
	public function getBsInputQuery(){

		$statement = <<<SQL
SELECT ac.account_category_name , ad.account_code, ad.account_name, IFNULL(SUM(i.amount), 0) as 'input_amount' 
FROM TBL_ACCOUNT_DETAIL ad 
LEFT JOIN 
(SELECT * FROM TBL_INPUT 
WHERE input_date BETWEEN '2020-01-01' AND '2020-03-31') i
ON ad.account_code = i.account_code 
LEFT JOIN TBL_ACCOUNT_CATEGORY ac 
ON ad.account_category_code = ac.account_category_code  
WHERE ad.account_flg = '0'
OR i.input_date BETWEEN '2020-01-01' AND '2020-03-31' 
GROUP BY ad.account_code
SQL;

		return $statement;
	}


	// 貸借対照表借方取得SQL
	public function getBsOutputQuery(){

		$statement = <<<SQL
SELECT ac.account_category_name , ad.account_code, ad.account_name, IFNULL(SUM(o.amount), 0) as 'output_amount' 
FROM TBL_ACCOUNT_DETAIL ad 
LEFT JOIN
(SELECT * FROM TBL_OUTPUT 
WHERE output_date BETWEEN '2020-01-01' AND '2020-03-31' ) o
ON ad.account_code = o.account_code 
LEFT JOIN TBL_ACCOUNT_CATEGORY ac 
ON ad.account_category_code = ac.account_category_code  
WHERE ad.account_flg = '1'
AND ad.account_category_code <> 6 
GROUP BY ad.account_code
SQL;

		return $statement;
	}


	// 貸借対照表純資産取得SQL
	public function getBsAssetQuery(){

		$statement = <<<SQL
SELECT ac.account_category_name , ad.account_code, ad.account_name, IFNULL(SUM(o.amount), 0) as 'output_amount' 
FROM TBL_ACCOUNT_DETAIL ad 
LEFT JOIN 
(SELECT * FROM TBL_OUTPUT 
WHERE output_date BETWEEN '2020-01-01' AND '2020-03-31' ) o
ON ad.account_code = o.account_code 
LEFT JOIN TBL_ACCOUNT_CATEGORY ac 
ON ad.account_category_code = ac.account_category_code  
WHERE ad.account_flg = '1'
AND ad.account_category_code = 6 
GROUP BY ad.account_code
SQL;

		return $statement;
	}


	public function getBsTotalQuery(){

		$statement = <<<SQL
SELECT IFNULL(SUM(i.amount), 0)  as amount ,
a.asset_name 
FROM TBL_ASSET a 
LEFT JOIN TBL_ACCOUNT_DETAIL ad 
ON a.asset_code = ad.asset_code 
LEFT JOIN TBL_INPUT i 
ON ad.account_code = i.account_code 
WHERE a.asset_code = 1 
GROUP BY a.asset_code
UNION 
SELECT IFNULL(SUM(o.amount), 0)  as amount, 
a.asset_name 
FROM TBL_ASSET a 
LEFT JOIN TBL_ACCOUNT_DETAIL ad 
ON a.asset_code = ad.asset_code 
LEFT JOIN TBL_OUTPUT o 
ON ad.account_code = o.account_code 
WHERE a.asset_code = 2
OR a.asset_code = 3
GROUP BY a.asset_code
SQL;

		return $statement;
	}

}

?>
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
			self::getBudgetquery()
		];
		return $statement;
	}

	public function getInputQuery(){

		$statement = 'SELECT i.input_code as "input_code", i.input_date as "input_date", u.use_name as "use_name", d.account_name as account_name, i.amount as "amount" FROM TBL_INPUT i INNER JOIN TBL_USE u on i.use_code = u.use_code INNER JOIN TBL_ACCOUNT_DETAIL d on i.account_code = d.account_code WHERE u.use_flg = "0" AND d.account_flg = "0"';

		return $statement;

	}

	public function getOutputQuery(){

		$statement = 'SELECT o.output_code as "output_code", o.output_date as "output_date", u.use_name as "use_name", d.account_name as "account_name", o.amount as "amount" FROM TBL_OUTPUT o INNER JOIN TBL_USE u on o.use_code = u.use_code INNER JOIN TBL_ACCOUNT_DETAIL d on o.account_code = d.account_code WHERE u.use_flg = "1" AND d.account_flg = "1"';

			return $statement;
	}

	public function getJournalQuery($startDate, $endDate, $use, $account){

		$statement = 'SELECT i.input_date as "date", u.use_name as "use_name", d.account_name as "account_name", i.amount as "amount" FROM TBL_INPUT i INNER JOIN TBL_USE u ON i.use_code = u.use_code INNER JOIN TBL_ACCOUNT_DETAIL as d ON i.account_code = d.account_code WHERE i.input_date BETWEEN "' .$startDate .'" AND "' .$endDate .'" UNION SELECT o.output_date as "date", u.use_name as "use_name", d.account_name as "account_name", o.amount as "amount" FROM TBL_OUTPUT o INNER JOIN TBL_USE u ON o.use_code = u.use_code INNER JOIN TBL_ACCOUNT_DETAIL as d ON o.account_code = d.account_code WHERE o.output_date BETWEEN "' .$startDate .'" AND "' .$endDate . '" AND o.use_code = ' .$use .' AND o.account_code = ' .$account;

			return $statement;

	}

	public function getBudgetQuery(){
		$statement = 'SELECT u.use_name, d.account_name, b.amount FROM TBL_BUDGET b INNER JOIN TBL_USE u on b.use_code = u.use_code INNER JOIN TBL_ACCOUNT_DETAIL d on b.account_code = d.account_code WHERE DATE_FORMAT(b.budget_month, "%Y-%m") = DATE_FORMAT(NOW(), "%Y-%m")';

		return $statement;
	}

	public function getBalanceQuery(){
		$statement = 'SELECT ';
	}

}

?>
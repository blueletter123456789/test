<?php

	/**
	 * 	DB連携用クラス
	 */
	class dbConnect
	{
		
		function __construct()
		{
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
		}

		public function connect(){
			$pdo = new PDO('mysql:dbname=pl_db;host=localhost;charset=utf8','root', 'root');
			return $pdo;

		}
	}



?>
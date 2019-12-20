<?PHP

	/**
	 * 
	 */
	class dbConnect
	{
		
		function __construct()
		{
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
		}
		public function connect(){
			$pdo = new PDO('mysql:dbname=logindb;host=localhost;charset=utf8','root', 'root');
			return $pdo;
		}
	}

?>
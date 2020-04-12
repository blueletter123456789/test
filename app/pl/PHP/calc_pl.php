<?php

	$path = dirname(__DIR__);

	if(isset($_GET['displayButton'])){
		$getMonth = $_GET['defaultMonth'];
		$year = date('Y', strtotime($getMonth));
		$month = date('m', strtotime($getMonth));
	}


	//テスト用データ
	// $year = '2020';
	// $month = '03';
	
	$calc = new calc_pl();
	$calc->readData($year, $month, $path);



/**
 * 
 */
class calc_pl
{

	// public $year;
	// public $month;
	// public $queryDate;

	// function __construct(){
	// 	$this->year = date('Y');
	// 	$this->month = date('m');
	// 	$this->queryDate = date('Y-m');
	// }


	public function writeData($queryDate, $year, $month){

		$phpPath = dirname(__FILE__);

		require_once ($phpPath."/dbConnect.php");
		require_once ($phpPath."/queryList.php");

		$tblNames = ['plInputData', 'plOutputData'];

		$db = new dbConnect();

		$pdo = $db -> connect();

		$queryList = new queryList();

		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $queryList -> getAllplQuery($queryDate);
		
		foreach ($statement as $key => $value) {
			$stmtAll[] = $pdo -> query($value);
		}

		foreach ($stmtAll as $key => $value) {
			$row[] = $value->fetchAll(PDO::FETCH_ASSOC);
		}

		$row = array_combine($tblNames, $row);



		//　ディレクトリ作成

		//作成したいディレクトリ（のパス）
		$data_directory = dirname(__DIR__);
		$year_directory = $data_directory .DIRECTORY_SEPARATOR .'data' .DIRECTORY_SEPARATOR .$year;
		$month_directory = $year_directory .DIRECTORY_SEPARATOR .$month;

		 
		//「$data_directory」で指定されたディレクトリが存在するか確認
		if(file_exists($year_directory)){
		    //存在したときの処理
		    echo "作成しようとした年のディレクトリは既に存在します";
		    if (file_exists($month_directory)) {
		    	echo "作成しようとした月のディレクトリは既に存在します";
		    }else{
		    	if (mkdir($month_directory, 0777)) {
		    		chmod($month_directory, 0777);
		    		echo "月の作成に成功しました";
		    	}else{
		    		echo "月の作成に失敗しました";
		    	}
		    }
		}else{
		    //存在しないときの処理（「$directory_path」で指定されたディレクトリを作成する）
		    if(mkdir($year_directory, 0777)){
		        //作成したディレクトリのパーミッションを確実に変更
		        chmod($year_directory, 0777);
		        //作成に成功した時の処理
		        echo "年の作成に成功しました";
		        if (mkdir($month_directory, 0777)) {
		        	chmod($month_directory, 0777);
		        	echo "月の作成に成功しました";
		        }else{
		        	echo "月の作成に失敗しました";
		        }
		    }else{
		        //作成に失敗した時の処理
		        echo "年の作成に失敗しました";
		    }
		}

		if (file_exists($month_directory)) {
			//jsonとして出力
			file_put_contents($month_directory.DIRECTORY_SEPARATOR.'data.json', json_encode($row, JSON_UNESCAPED_UNICODE));
			// header('Content-type: '.$month_directory.'data.json');
			// echo json_encode($row);
		}

		self::readData($year, $month, $data_directory);

	}

	public function readData($year, $month, $data_directory){

		$year_directory =  $data_directory .DIRECTORY_SEPARATOR .'data' .DIRECTORY_SEPARATOR .$year;
		$month_directory = $year_directory .DIRECTORY_SEPARATOR .$month;

		$json = file_get_contents($month_directory.DIRECTORY_SEPARATOR.'data.json');
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

		echo $json;

	}

}

	

?>
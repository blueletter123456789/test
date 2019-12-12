$(function(){

	// 表示用変数
	var dspval = 0;

	// 保存用変数
	var preval = 0;
	var optval = '+';

	// 演算子フラグ
	var valflg = 0;


// 実行する関数群
	output(dspval);
	numClick();
	optClick();
	clear();
	dot();
	changeSign();
	perClick();

// 出力用関数
	function output(val){

	// 変数valをdisplayクラスに表示
		$('.display span').text(val);
	}

// 表示されている数の獲得用関数
	function input(){

	// displayクラスにあるテキストをリターン
		return $('.display span').text();
	}

// 数字入力用関数
	function numClick(){

	// 数字ボタンが押下される
		$('.num').on('click', function(){
			var val = $(this).val();

		// 数字が押下される前の入力されたボタンのチェック
			if(valflg == 1){
				valflg = 0;
			}else{
				val = input() + val;
			}

		// 小数点以下の入力可能チェック
			val = (input().match(/\./)) ? val : Number(val);

		// 数字の出力
			output(val);

		});
	}

// 記号の入力用関数
	function optClick(){
	// 記号ボタンが押下される
		$('.operator').on('click', function(){
			var ope = $(this).val();

		// 押下されたボタンが乗算、除算の場合の変換チェック
			if(ope == '÷'){ ope = '/';}
			if(ope == '×'){ ope = '*';}

		// 前に押下されたボタンが数字or'='の場合は計算関数の実行
			if(valflg != 1) calc();

		// 前に入力されたボタンが'='以外の場合は
			if(ope != '='){optval = ope;}

		// フラグを立てる
			valflg = 1;
		});

	}

// 計算用関数
	function calc(){
	// 現在入力されている数字を代入
		dspval = input();

	// 前回入力された数字、記号、現在入力されている数字を結合して代入
		var calcu = preval + optval + dspval;

	// 結合された式を実行
		calcu = eval(calcu);

	// 出力
		output(calcu);

	// 計算結果を代入
		preval = calcu;
	}

// 初期処理用関数
	function clear(){
		$('.clear').on('click', function(){
			dspval = 0;
			preval = 0;
			optval = '+';
			valflg = 0;
			output(dspval);
		});
	}

// 小数点入力用関数
	function dot(){
	// コンマが押下される
		$('.dot').on('click', function(){
			var val = $(this).val();

		// 前回押下されたボタンのチェック
			// 記号の場合
			if(valflg==1){
				// 前に0を付加
				val = '0.';
			// 数字の場合
			}else{
				// 表示されている数字にコンマを付加
				val = input() + val;
				// 既にコンマが入力されている場合は処理を中断
				if(input().match(/\./g)) return;
			}

		// 数字として処理
			valflg=0;

		// 出力
			output(val);

		})
	}

// プラス／マイナスの変換ボタン用関数
	function changeSign(){
	// 変換ボタンが押下される
		$('.sign').on('click', function(){

		// 数字に変換			
			var num = Number(input());

		// 0以外の場合は-1を乗算
			if(num!=0)num *= -1;

		// 計算した数字を出力
			output(num);

		})
	}

// パーセントボタン用関数
	function perClick(){
		$('.percentage').on('click', function(){
		// 数字に変換
			var num = Number(input());

		// 100で除算
			num /= 100;

		// 計算した数字を出力
			output(num);

		});
	}

})
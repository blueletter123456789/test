$(function(){

	// 表示用変数
	var dspval = 0;

	// 保存用変数
	var preval = 0;
	var optval = '+';

	// 演算子フラグ
	var valflg = 0;



	output(dspval);
	numClick();
	optClick();
	clear();
	dot();


	function output(val){
		$('.display span').text(val);
	}

	function input(){
		return $('.display span').text();
	}

	function numClick(){
		$('.num').on('click', function(){
			var val = $(this).val();

			if(valflg == 1){
				valflg = 0;
			}else{
				val = input() + val;
			}

			val = (input().match(/\./)) ? val : Number(val);

			output(val);

		});
	}

	function optClick(){
		$('.operator').on('click', function(){
			var ope = $(this).val();

			if(ope == '÷'){ ope = '/';}
			if(ope == '×'){ ope = '*';}

			if(valflg != 1) calc();

			if(ope != '='){optval = ope;}

			valflg = 1;
		});

	}

	function calc(){
		dspval = input();

		var calcu = preval + optval + dspval;

		calcu = eval(calcu);

		output(calcu);

		preval = calcu;
	}

	function clear(){
		$('.clear').on('click', function(){
			dspval = 0;
			preval = 0;
			optval = '+';
			valflg = 0;
			output(dspval);
		});
	}

	function dot(){
		$('.dot').on('click', function(){
			var val = $(this).val();

			if(valflg==1){
				val = '0.';
			}else{
				val = input() + val;
				if(input().match(/\./g)) return;
			}
			valflg=0;
			output(val);

		})
	}





})
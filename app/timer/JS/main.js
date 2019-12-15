var timer = new Vue({
	el:'#timer', 

	// 変数定義エリア
	data:{
		hour:0, 
		minute:0, 
		second:0,
		status:true,
		disp:true,
		start_flg:0, 
	},

	// アプリ内関数
	methods:{
		// カウントダウン関数（スタート用関数）
		countDown:function(){

			this.status = false;
			this.disp = false;
			this.start_flg = 1;

			let self = this;
			this.obj = setInterval(function(){self.countDown()},1000);
		},
		// リセット関数
		reset:function(){
			this.hour = 0;
			this.minute = 0;
			this.second = 0;
			this.start_flg = 0;
		},
		// ストップ関数
		stop:function(){
			this.status = true;
		},
		// カウントセット関数
		countSet:function(){

		},
	}
});
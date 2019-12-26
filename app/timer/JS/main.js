const timer = new Vue({
	el:'#timer', 

	// 変数定義エリア
	data:{
		hour:0, 
		minute:0, 
		second:0,
		btn_status:true,
		disp:true, 
		obj:null,
	},

	// アプリ内関数
	methods:{
		// カウントダウン関数（スタート用関数）
		start(){

			// console.log('chk');

			this.btn_status = false;
			this.disp = false;

			let self = this;
			this.obj = setInterval(function(){self.countDown()},1000);
		},
		// リセット関数
		reset(){
			this.hour = 0;
			this.minute = 0;
			this.second = 0;
			this.disp = true;
			this.btn_status = true;
		},

		// ストップ関数
		stop(){
			this.btn_status = true;
			clearInterval(this.obj);
		},

		// カウントダウン実施関数
		countDown(){
			if (this.second==0) {
				if(this.hour==0 && this.minute==0) {
					alert('完了！');
					this.stop();
					this.reset();
					return;
				}else if(this.minute>0){
					this.minute--;
					this.second=59;
				}else if(this.hour>0){
					this.hour--;
					this.minute=59;
					this.second=59;
				}	
			}else{
				this.second--;
			}
		},
	},

	updated(){
		if(!this.disp){
			console.log('chk');
			if(String(this.hour).length < 2){
				this.hour = '0' + String(this.hour);
			}
			if(String(this.minute).length < 2){
				this.minute = '0' + String(this.minute);
			}
			if(String(this.second).length < 2){
				this.second = '0' + String(this.second);
			}
		}else{
			this.hour = Number(this.hour);
			this.minute = Number(this.minute);
			this.second = Number(this.second);
		}
	}

});
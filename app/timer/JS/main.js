console.log('chk');
var timer = new Vue({
	el:'#timer', 
	data:{
		hour:0, 
		minute:0, 
		second:0,
		status:true,
	},
	methods:{
		countDown:function(){
			this.second--;
			this.status = false;
		},
		reset:function(){
			this.hour = 0;
			this.minute = 0;
			this.second = 0;
		},
		stop:function(){
			this.status = true;
		},
	}
});
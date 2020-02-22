var pl = new Vue({
	el:'#account', 
	data:{
		disp: true, 
		hidden: false, 
		registerTitle: 'Input'
	}, 
	methods:{
		registerTab: function(){
			alert('tab');
		}, 
		displayPage: function(){
			alert('page');
		}
	}


})
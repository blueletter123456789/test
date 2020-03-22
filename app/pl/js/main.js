var pl = new Vue({
	el:'#account', 
	data:{
		activePage: 1, 
		registerTab: 1, 
		balanceTab: 1, 
		bsTab: 1, 
		accountInputList: '', 
		accountOutputList: '', 
		useInputList: '', 
		useOutputList: '', 
		inputList: '', 
		outputList: '',
		journalList: '', 
		budgetList: '', 
		balanceList: '', 
		bsInputList: '', 
		bsOutputList: '', 
		bsAssetList: [], 
		bsTotalList: '', 
		plMonthList: '', 
		defaultDate: '',  
		startDate: '', 
		endDate: '', 
		defaultMonth: ''
	}, 
	methods: {
		getData: function(){
		    axios
		      .get('./PHP/pdo_select.php')
		      .then(response => {this.accountInputList = response.data.accountInputData, 
		      					this.accountOutputList = response.data.accountOutputData, 
		      					this.useInputList = response.data.useInputData, 
		      					this.useOutputList = response.data.useOutputData, 
		      					this.inputList = response.data.inputData, 
		      					this.outputList = response.data.outputData, 
		      					this.journalList = response.data.journalData, 
		      					this.budgetList = response.data.budgetData, 
		      					this.balanceList = response.data.balanceData, 
		      					this.bsInputList = response.data.bsInputData, 
		      					this.bsOutputList = response.data.bsOutputData, 
		      					this.bsAssetList = response.data.bsAssetData, 
		      					this.bsTotalList = response.data.bsTotalData, 
		      					this.plMonthList = response.data.plMonthData, 
		      					console.log(response)
		    })
		    .catch(function (error) {
            	console.log(error);
            });
		}, 
		getDefaultDate: function(defaultDate, startDate, endDate, defaultMonth){
			var today = new Date();
		    today.setDate(today.getDate());
		    var yyyy = today.getFullYear();
		    var mm = ("0"+(today.getMonth()+1)).slice(-2);
		    var dd = ("0"+today.getDate()).slice(-2);
		    this.defaultDate = yyyy+'-'+mm+'-'+dd;
		    this.startDate = yyyy+'-'+mm+'-'+dd;
		    this.endDate = yyyy+'-'+mm+'-'+dd; 
		    this.defaultMonth = yyyy+'-'+mm;
    	}
	}, 
	mounted(){
		this.getData(); 
		this.getDefaultDate();　
  }
  
})


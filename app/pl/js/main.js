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
		plInputList: '', 
		plInputTotalList: [], 
		plOutputList: '', 
		plOutputTotalList: [], 
		plProfitTotalList: '', 
		defaultDate: '',  
		startDate: '', 
		endDate: '', 
		defaultMonth: '', 
		use_code: '', 
		account_code: '', 
		displayButton: '表示'
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
		      					console.log(response)
		    })
		    .catch(function (error) {
            	console.log(error);
            });
            axios 
    		.get('php/calc_pl.php', {
    			params: {
    					defaultMonth: this.defaultMonth, 
    					displayButton: this.displayButton
    				}
    		})
    		.then(response => {this.plInputList = response.data.plInputData, 
    							this.plInputTotalList = response.data.plInputTotalData, 
    							this.plOutputList = response.data.plOutputData, 
    							this.plOutputTotalList = response.data.plOutputTotalData, 
    							this.plProfitTotalList = response.data.plProfitTotalData, 
    							console.log(response)
    			})
		    .catch(function (error) {
            	console.log(error);
            });
		}, 
		getDefaultDate: function(){
			var today = new Date();
		    today.setDate(today.getDate());
		    var yyyy = today.getFullYear();
		    var mm = ("0"+(today.getMonth()+1)).slice(-2);
		    var dd = ("0"+today.getDate()).slice(-2);
		    this.defaultDate = yyyy+'-'+mm+'-'+dd;
		    this.startDate = yyyy+'-'+mm+'-'+dd;
		    this.endDate = yyyy+'-'+mm+'-'+dd; 
		    this.defaultMonth = yyyy+'-'+mm;
    	}, 
    	onClick: function() {
    		axios 
    		.get('php/pdo_select.php', {
    			params: {
    					startDate: this.startDate, 
    					endDate: this.endDate, 
    					use_code: this.use_code, 
    					account_code: this.account_code, 
    					defaultMonth: this.defaultMonth, 
    					displayButton: this.displayButton
    				}
    		})
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
		      					console.log(response)
    			})
		    .catch(function (error) {
            	console.log(error);
            });
            axios 
    		.get('php/calc_pl.php', {
    			params: {
    					defaultMonth: this.defaultMonth, 
    					displayButton: this.displayButton
    				}
    		})
    		.then(response => {this.plInputList = response.data.plInputData, 
    							this.plInputTotalList = response.data.plInputTotalData, 
    							this.plOutputList = response.data.plOutputData, 
    							this.plOutputTotalList = response.data.plOutputTotalData, 
    							this.plProfitTotalList = response.data.plProfitTotalData, 
    							console.log(response)
    			})
		    .catch(function (error) {
            	console.log(error);
            });
    	}
	}, 
	mounted(){
		this.getDefaultDate(); 
		this.getData(); 
  }
})


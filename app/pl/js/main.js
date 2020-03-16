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
		bsAssetList: '', 
		bsTotalList: [], 
		plRecords: [
			{ id: 1, subject: '売上高', amount: '30000'},
			{ id: 2, subject: '売上原価', amount: '30000'},
			{ id: 3, subject: '売上総利益', amount: '30000'},
			{ id: 4, subject: '販売費及び一般管理費', amount: '30000'},
			{ id: 5, subject: '営業利益', amount: '30000'},
			{ id: 6, subject: '営業外収益', amount: '30000'},
			{ id: 7, subject: '営業外費用', amount: '30000'},
			{ id: 8, subject: '経常利益', amount: '30000'},
			{ id: 9, subject: '特別利益', amount: '30000'},
			{ id: 10, subject: '特別損失', amount: '30000'},
			{ id: 11, subject: '税引前登記純利益', amount: '30000'},
			{ id: 12, subject: '税引後当期純利益', amount: '30000'}
		], 
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
		}
	}, 
	mounted(){
		this.getData();
  }
})


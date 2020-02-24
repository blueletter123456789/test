var pl = new Vue({
	el:'#account', 
	data:{
		activePage: 1, 
		registerTab: 1, 
		balanceTab: 1, 
		bsTab: 1, 
		registerList: [
			{ id: 1, date: '2020/02/05', use:'生活費', account: '事業借主', amount: '50000'}
		], 
		journalList: [ 
			{ id: 1, date: '2020/02/24', use: '給与', account: '現金', amount: '300000' },
			{ id: 2, date: '2020/02/24', use: '食費', account: '事業主借', amount: '30000' }
		], 
		budgetList: [
			{ id: 1, use:'生活費', account: '事業借主', amount: '50000'}
		], 
		balanceList: [
			{ id: 1, debitBaelance: '20000', debitTotal: '30000', account: '事業借主', creditorTotal: '2000', creditorBalance: '30000'}
		], 
		assetCategories: [
			{ id: 1, title: '流動資産', assetRecords: [
				{ id: 1, account: '現金', amount: '300000'}
			]}
		], 
		debtCategories: [
			{ id: 1, title: '流動負債', debtRecords: [
				{ id: 1, account: '買掛金', amount: '30000'}
			]}
		], 
		assetTotal: '30000', 
		debtTotal: '3000'
	}
})


//Lesson 1 vue.js
// Count Up + LocalStorage / SessionStorage について理解する

var app = new Vue({
	//機能する場所を選択する
	el:'#app',
	//HTML側、js内共通変数
	data:{
		product:'Socks',
		counter:0,
		ssCounter:0
	},
	//関数function部分、JSON形式で記入
	methods:{
		//カウントアップ関数
		count(){
			this.counter++;
			this.saveAs(this.jsonStr(this.counter),'counter');
		},
		//SessionStrage 用
		sesCount(){
			this.ssCounter++;
			sessionStorage.setItem('ssCounter', this.ssCounter);
			//this.saveSes(this.jsonstr(this.ssCounter),'ssCounter');
			console.log('chk');
		},
		//LocalStorageにカウント情報を保存
		saveAs(parsed,target){
			localStorage.setItem(target, parsed);
		},
		saveSes(parsed,target){
			sessionStorage[target] = parsed;
		},
		//JSONフォーマットに変換処理
		jsonStr(str){
			 return JSON.stringify(str);
		},
		//LocalStorageに保存したデータのリセット処理、表示変数のリセット
		deleteStorage(){
			localStorage.removeItem('counter');
			sessionStorage.removeItem('ssCounter');
			this.counter = 0;
			this.ssCounter = 0;
		}
	},
	//読み込み時に起動（Launch）する
	mounted() {
		//LocalStorageに保存されている際、読み込みを行い反映処理
		if(localStorage.getItem('counter')) {
			try {
				this.counter = JSON.parse(localStorage.getItem('counter'));
			} catch(e) {
				//完了後の処理
				this.saveAs(this.jsonStr(this.counter),'counter');
			}
		}
		//SessionStorageに保存されている際、読み込み込みを行い反映処理sessionStorage.getItem('key')
		if(sessionStorage.getItem('ssCounter')){
			try {
				this.ssCounter = JSON.parse(sessionStorage.getItem('ssCounter'));
			} catch(e) {
				//完了後の処理
				this.saveAs(this.jsonStr(this.ssCounter),'ssCounter');
			}

		}
	}
})
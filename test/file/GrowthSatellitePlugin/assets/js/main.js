jQuery(function($){
	$('input[name="period"]').on('click', function(){
		var val = $(this).val();
		if(val==0){
			$('#dateParam').css({'display':'none'});
			$('form input[type="date"]').attr('disabled', true);
			$('form input[type="date"]').attr('required', true);
		}else{
			$('#dateParam').css({'display':'flex'});
			$('form input[type="date"]').attr('disabled', false);
			$('form input[type="date"]').attr('required', false);
		}
	});
	periodType();
	$('#periodall, #perioddesign').on('click', function(){
		periodType();
	});
	$('#passshow').on('click', function(){
		// pass
		($('#passshow').prop('checked')) ? $('#password').attr('type','text') : $('#password').attr('type','password');
		if($('#passshow').prop('checked')){
			$('label.icon').removeClass('show');
			$('label.icon').addClass('unshow');
		}else{
			$('label.icon').removeClass('unshow');
			$('label.icon').addClass('show');
		}
	});
	var param = 0;
	$('#param').on('click', function(){
		param = $('#param').prop('checked') ? 1 : 0;
	});
	var api_url = (typeof gs_tag_api_url != "undefined") ? gs_tag_api_url : '';
	$('#tag').on('click', function(){

		$.ajax(api_url+'?param='+param,
			{
				type: 'post',
				data:{
					param:param,
				},
				dataType: 'json',
				beforeSend: function() { // 通信前に実行
					$('#ajax_loading').addClass('active');
					$('#ajax_loading').removeClass('inactive');
                },
			}
		)
		.done(function(data) {
			(data) ? alert('反映処理が完了しました。') : alert('対象のタグが存在しませんでした。');
		})
		.then(function(){
			$('#ajax_loading').removeClass('active');
			$('#ajax_loading').addClass('inactive');
		})
		.fail(function() {
			alert('通信障害が発生しました。通信環境をご確認の上、再度実行してください。');
		});
		return false;
	});
	$('#afterDate, #beforeDate').on('blur', function(){
		dateCheck($(this));
		ajaxPostsCheck();
	});
	$('#download_label').on('click',function(){
		if( $('#afterDate').val().match(/(\d{4}-\d{2}-\d{2})|(\d{4}\/\d{2}\/\d{2})/) && $('#beforeDate').val().match(/(\d{4}-\d{2}-\d{2})|(\d{4}\/\d{2}\/\d{2})/) ){
			return true;
		}else{
			alert('日付の入力形式が異なります。yyyy-mm-ddまたは、yyyy/mm/ddでご入力ください。\r\n\r\n例：2020/06/11\r\n2020-06-01');
			return false;
		}
	})
	$("input"). keydown(function(e) {
		return ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) ? false : true;
	});
	function dateConvert(str){
		if(str.match(/^\d{8}$/)){
			var arr = (str.substr(0, 4) + '-' + str.substr(4, 2) + '-' + str.substr(6, 2)).split('/');
			return arr[0];
		}
		return false;
	}
	function dateCheck($this){
		var date = $this.val();
		var alert_id = $this.attr('id').replace('Date', '_alert');

		if(date.match(/(\d{4}-\d{2}-\d{2})|(\d{4}\/\d{2}\/\d{2})/)){
			$('#' + alert_id).text('');
		}else{
			var newDate = dateConvert(date);
			if(newDate!=false){
				$(this).val(newDate);
				$('#' + alert_id).text('');
			}else{
				$('#' + alert_id).text('日付の形式に誤りがあります。ご確認ください。');
				return false;
			}
		}
	}
	function ajaxPostsCheck(){
		if (typeof gs_tag_ajax_url == 'undefined' ||  gs_tag_ajax_url == null || gs_tag_ajax_url == undefined) return false;
		$form = $('#dateform');
		$.ajax({
			url : gs_tag_ajax_url, //Formのアクションを取得して指定する
			type: $form.attr('method'),//Formのメソッドを取得して指定する
			data: $form.serialize(),　 //データにFormがserialzeした結果を入れる
		})
		.done(function(data) {
			if(data!=1){
				$('#download_label').addClass('disable');
				$('#post_alert').text('対象の記事が存在しません。対象の期間をご確認の上、再度ご入力ください。');
				$('#download').attr('disabled',true);
				return false;
			}else{
				$('#download_label').removeClass('disable');
				$('#post_alert').text('');
				$('#download').attr('disabled',false);
				return true;
			}
		})
		.fail(function() {
			alert('通信障害が発生しました。通信環境をご確認の上、再度実行してください。');
			return false;
		});
	}
	function periodType(){
		ajaxPostsCheck();
		if($('#periodall').prop('checked')){
			$('#dateParam').css({'display':'none'});
		}else{
			$('#dateParam').css({'display':'flex'});
		}
	}
});
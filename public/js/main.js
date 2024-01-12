	const api_url = 'http://online.shop.com';
	
	//--------- User Registration ------------//
	
    $('.registration').on('click', function(){
        var name = $('.name').val().trim();
        var email = $('.email').val().trim();
		var phone = $('.phone').val().trim();
        var password = $('.password').val().trim();
        $(this).closest('form').find('input').removeClass('border-danger');

        $.ajax({
            url :`${api_url}/users/registration`,
            type :'post',
            dataType :'json',
            data :{ name : name, email : email, phone : phone, password : password },
            success : function(res){
				
                if (res.empty_keys.length > 0){
                    for (let i = 0; i < res.empty_keys.length; i++) {
                        $('.'+res.empty_keys[i]).addClass('border-danger');
                    }
                    $('.message').html('<div class = "alert alert-danger">'+ res.error_msg +'</div>')
                } else {
					if (res.success_msg == "") {
						if (res.error_pas != ""){
							$('.message').html('<div class = "alert alert-danger">'+ res.error_pas +'</div>')
							$('.password').val('').addClass('border-danger');
						}
						if (res.error_msg != "") {
							$('.message').html('<div class = "alert alert-danger">'+ res.error_msg +'</div>')
							$('.email').val('').addClass('border-danger');
						}
						
					} else {
						$('.message').html('<div class = "alert alert-success">'+ res.success_msg +'</div>')
						$('.name').val('');
						$('.email').val('');
						$('.phone').val('');
						$('.password').val('');
					}
				}
				
            }
        })
    })
	
	//--------- User Login ------------//
	
    $('.user_login').on('click', function(){
        var login_email = $('.login_email').val().trim();
        var login_password = $('.login_password').val().trim();
        $(this).closest('form').find('input').removeClass('border-danger');
        $.ajax({
            url :`${api_url}/users/login`,
            type :'post',
            dataType :'json',
            data :{ login_email : login_email, login_password : login_password },
            success : function(res){
                if (res.empty_keys.length > 0){
                    for (let i = 0; i < res.empty_keys.length; i++) {
                        $('.'+res.empty_keys[i]).addClass('border-danger');
                    }
                    $('.msg').html('<div class = "alert alert-danger">'+ res.error_msg +'</div>');
                } else {
					if (res.request_url.length == 0) {
						$('.msg').html('<div class = "alert alert-danger">'+ res.error_msg +'</div>');
						$('.login_email').val('').addClass('border-danger');
						$('.login_password').val('').addClass('border-danger');
					} else {
						window.location.href = res.request_url;
					}
				}
            }
        })
    })
	
	//--------- add basket ------------//
	
	$('.add_basket').on('click', function(){
		id_product = $(this).data('id_product');
		$.ajax({
			url:`${api_url}/users/add_basket`,
			type:'post',
			dataType: 'json',
			data:{ id_product : id_product },
			success: function(res){
				$.ajax({
					url:`${api_url}/users/basket_show`,
					type:'post',
					dataType: 'json',
					data:{ },
					success: function(res){
						$('.container_basket').html(res)
						$("#basket-dropdown").toggleClass('show');
					}
				});
			}
		});
	});
	
	//--------- basket ------------//
	
	$('.basket').on('click', function(){
		$.ajax({
			url:`${api_url}/users/basket_show`,
			type:'post',
			dataType: 'json',
			data:{ },
			success: function(res){
				$('.container_basket').html(res)
			}
		});
	});
	
	//--------- row del basket ------------//
	
	$(document).on('click','.row_del_basket',function() {
		id_product = $(this).data('id_product');
		row = $(this).closest('.basket_product');
		$.ajax({
			url:`${api_url}/users/row_del_basket`,
			type:'post',
			dataType: 'json',
			data:{ id_product : id_product },
			success: function(res){
				if (res['true'] == 1) {
					row.fadeOut(750, function(){
						$(this).remove();
					});
				}
				$.ajax({
					url:`${api_url}/users/basket_show`,
					type:'post',
					dataType: 'json',
					data:{ },
					success: function(res){
						$('.container_basket').html(res)
					}
				});
			}
		});
	});
	
	//--------- plus ------------//
	
	$(document).on('click','.plus',function(){
		product_id = $(this).data('product_id');
		$.ajax({
			url: `${api_url}/users/count_plus`,
			type: 'post',
			dataType:'json',
			data: { product_id : product_id },
			success: function(res){
				$.ajax({
					url:`${api_url}/users/basket_show`,
					type:'post',
					dataType: 'json',
					data:{ },
					success: function(res){
						$('.container_basket').html(res)
					}
				});
			}
		})
	})
	
	//--------- minus ------------//
	
	$(document).on('click','.minus',function(){
		product_id = $(this).data('product_id');
		$.ajax({
			url: `${api_url}/users/count_minus`,
			type: 'post',
			dataType:'json',
			data: { product_id : product_id },
			success: function(res){
				$.ajax({
					url:`${api_url}/users/basket_show`,
					type:'post',
					dataType: 'json',
					data:{ },
					success: function(res){
						$('.container_basket').html(res)
					}
				});
			}
		})
	})
	
	//--------- dropdown ------------//
	
	$('.basket-dropdown-toggle').on('click', function (event) {
		$("#basket-dropdown").css({
			'position': 'absolute',
			'transform': 'translate(5px, 44px)',
		});
		$("#basket-dropdown").toggleClass('show');
	});
	
	$('body').on('click', function (e) {
		if (!$('#basket-dropdown').is(e.target) 
			&& !$('.basket-dropdown-toggle').is(e.target)
			&& $('#basket-dropdown').has(e.target).length === 0 
			&& $('.show').has(e.target).length === 0
		) {
			$('#basket-dropdown').removeClass('show');
		}
	});
	
	//--------- Payment Card ------------//
	
	$(document).ready(function(){

	//For Card Number formatted input
	var cardNum = document.getElementById('cr_no');
	cardNum.onkeyup = function (e) {
		if (this.value == this.lastValue) return;
		var caretPosition = this.selectionStart;
		var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
		var parts = [];
		
		for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
			parts.push(sanitizedValue.substring(i, i + 4));
		}
		
		for (var i = caretPosition - 1; i >= 0; i--) {
			var c = this.value[i];
			if (c < '0' || c > '9') {
				caretPosition--;
			}
		}
		caretPosition += Math.floor(caretPosition / 4);
		
		this.value = this.lastValue = parts.join(' ');
		this.selectionStart = this.selectionEnd = caretPosition;
	}

	//For Date formatted input
	var expDate = document.getElementById('exp');
	expDate.onkeyup = function (e) {
		if (this.value == this.lastValue) return;
		var caretPosition = this.selectionStart;
		var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
		var parts = [];
		
		for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
			parts.push(sanitizedValue.substring(i, i + 2));
		}
		
		for (var i = caretPosition - 1; i >= 0; i--) {
			var c = this.value[i];
			if (c < '0' || c > '9') {
				caretPosition--;
			}
		}
		caretPosition += Math.floor(caretPosition / 2);
		
		this.value = this.lastValue = parts.join('/');
		this.selectionStart = this.selectionEnd = caretPosition;
	}

	});
	
	
	

	const api_url = 'http://online.shop.com';
	var row_id , row;

	//--------- Admin Login ------------//
	
    $('.admin_login').on('click', function(){
        var admin_user = $('.admin_user').val().trim();
        var admin_pass = $('.admin_pass').val().trim();
        $(this).closest('form').find('input').removeClass('border-danger');
        $.ajax({
            url :`${api_url}/admin/login`,
            type :'post',
            dataType :'json',
            data :{ admin_user : admin_user, admin_pass : admin_pass },
            success : function(res){
				console.log(res);
                if (res.empty_keys.length > 0){
                    for (let i = 0; i < res.empty_keys.length; i++) {
                        $('.'+res.empty_keys[i]).addClass('border-danger');
                    }
                    $('.error_msg').html('<div class = "alert alert-danger">'+ res.error_msg +'</div>')
                } else {
					if (res.request_url.length == 0) {
						$('.error_msg').html('<div class = "alert alert-danger">'+ res.error_msg +'</div>');
						$('.admin_user').val('');
						$('.admin_pass').val('');
					} else {
						window.location.href = res.request_url;
					}
				}
            }
        })
    })
	
	//--------- Row Delete ------------//
	
	 $('.row_del').on('click', function(){
		row_id = $(this).data('id');
		row = $(this).closest('.table_product');
	 })
	 
	  $('#yes_del').on('click', function(){
		$.ajax({
			url:`${api_url}/admin/deleteRow`,
			type:'post',
			data:{ row_del_id:row_id },
			success: function(res){
				if (res == 1) {
					row.fadeOut(750, function(){
						$(this).remove();
					});
				}
			}
			});
	});
	
	//--------- Row Edite ------------//
	
	$('.row_edit').on('click', function(){
		row_id = $(this).data('id');
		console.log($(this));
		$.ajax({
			url:`${api_url}/admin/editeRow`,
			type:'post',
			dataType: 'json',
			data:{ row_edite_id:row_id },
			success: function(res){
				
				$('.img_main_modal').attr('src', res.image);
				$('.edit_form .form-floating').children().each(function(){
					$(this).val(res[$(this).attr('name')]);
				});
				$('.edit_id').val(res['id']);
			}
		});
	});
	
	//--------- Row Num ------------//
	
	$(document).ready(function(){
		$('#sortable').sortable({ update: function(event, ui) {
			data = [];
			$('.ui-state-default').each(function(index){
				data[index] = $(this).data('id');
				console.log($(this).data('id'));
			})
			console.log(data);
			$.ajax({
				url:`${api_url}/admin/editeNum`,
				type:'post',
				data:{ data }
			});
		}}); 
	});
	
	
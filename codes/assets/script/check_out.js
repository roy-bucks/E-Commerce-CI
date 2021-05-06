$(document).ready(function(){

	$.get('/shops/cart_details', function(res){
			$('#order_details').html(res);	
	});
	$(document).on("click",'#delete_order', function(){
		var href = $(this).attr('href');
		if(confirm('Are you sure?')){
			$.get(href, function(res){
				$.get('/shops/cart_details', function(res){
					$('#order_details').html(res);	
				});
					
			});
			return false;
		}
		else{
			return false;	
		}
	});

	$(document).on("click",'#check_out', function(){
			$('#modal1').show();		
	});
	$(document).on("click",'#close', function(){
			$('#modal1').hide();
			$('#modal2').hide();		
	});

	$(document).on("click",'#next_process', function(){
			$('#modal1').hide();
			$('#modal2').show();	
	});

	$(document).on("click", '#auto_fill', function(){
	  		if(!$(this).is(':checked')){
	  			$('#first_name').val('');
		  		$('#last_name').val('');
		  		$('#address').val('');
		  		$('#address2').val('');
		  		$('#city').val('');
		  		$('#state').val('');
		  		$('#zip_code').val('');
	  		}
	  		else{
	  		$.post($('#shipping_info').attr("action"), $('#shipping_info').serialize(), function(res){
		  		 	$('#first_name').val(res['data']['first_name']);
		  		 	$('#last_name').val(res['data']['last_name']);
		  		 	$('#address').val(res['data']['address']);
		  		 	$('#address2').val(res['data']['address2']);
		  		 	$('#city').val(res['data']['city']);
		  		 	$('#state').val(res['data']['state']);
		  		 	$('#zip_code').val(res['data']['zip_code']);
	  		},'json');

	  		}
	});

	$(document).on("click", '#check_out_process', function(){
		var user_id = $('#user_id').val();
		var total = $('#total').val();	
		var order_id = $('#order_id').val();
		$('#order_id_main').val(order_id);
		$('#user_id_main').val(user_id);
		$.post("/shops/submit_shipping_details", $("#shipping_info").serialize(), function(data) {
			$('#billing_info #shipping_id_main').val(data);

			$.post($('#billing_info').attr("action"), $('#billing_info').serialize(), function(res){
		  		alert('Thank You!');
		  		$('#modal1').hide();
				$('#modal2').hide();
				$.get('/shops/cart_details', function(res){
						$('#order_details').html(res);	
				});

		  	});
	   	},'json');
	   	$('#billing_info #order_id_main').val(order_id);
		$('#billing_info #user_id_main').val(user_id);

	});

});
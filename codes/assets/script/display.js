$(document).ready(function(){
		
		var id = $('#product_id').val();

		$.get('/shops/product_display/'+id, function(res){
			$('#product_details').html(res);	
		});

		$.get('/shops/number_of_product_in_cart', function(res){
			$('#cart_value').html('<span>('+res+' )</span>');
		})

		$(document).on("click",'#add_to_cart', function(){
			$('#modal').show();		
		});
		$(document).on("click",'#close', function(){
			$('#modal').hide();
				
		});
		$(document).on("click",'#add_to_cart_direct', function(){
			var product_id = $('#product_id').val();
			var order_qty = $('#order_qty').val();
			$.get('/save_on_cart/'+product_id+'/'+order_qty, function(res){
				alert('Added to your Cart!')
				$.get('/shops/number_of_product_in_cart', function(res){
					$('#cart_value').html('<span>('+res+' )</span>');
				})
				$('#modal').hide();
		});	

		});
		$(document).on("click",'#buy_now', function(){	
			var product_id = $('#product_id').val();
			$.get('/save_on_cart/'+product_id+'/1', function(res){
				alert('Added To Your Cart!')				
			})
		});
		
});
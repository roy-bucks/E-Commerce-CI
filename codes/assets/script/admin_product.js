	$(document).ready(function(){
		$.get('shops/display_admin_product_data/0', function(res){
			$('#table').html(res);	
		});

		$(document).on("keyup",'form', function(){
	 		$.post($(this).attr('action'), $(this).serialize(), function(res) {
		 		 	$('#table').html(res);
	 		});
	 	return false;
		 });

		$(document).on("blur",'form', function(){
			$.get('shops/display_admin_product_data/0', function(res){
				$('#table').html(res);	
			});
	 		
		 });

		$(document).on("click",'.pages', function(e){
			var href = $(this).attr('href');
			$.get(href, function(res){
				$('#table').html(res);	
			});
			return false;
		 });
		$(document).on("click", "#delete_product", function(){
			if(confirm("Are you sure you want to delete this product?")){
				var href = $(this).attr('href');
					$.get(href, function(res){
						$.get('shops/display_admin_product_data/0', function(res){
							$('#table').html(res);	
						});
				});
				return false;
			}
			else{
				return false;
			}
		})

	});	    

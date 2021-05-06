	$(document).ready(function(){
		$.get('shops/home_navigation', function(res){
			$('#on-show-category').val('all');
			$('#list').html(res);
			$('#all').css("background-color", "red");
		});

		$.get('/shops/number_of_product_in_cart', function(res){
			$('#cart_value').html('<span>('+res+' )</span>');
		})

		$.get('shops/display_user_product_data/0', function(res){
			$('#product-display').html(res);	
		});
		$(document).on("keyup",'form', function(){
	  		$.post($(this).attr('action'), $(this).serialize(), function(res) {
		  		 	$('#product-display').html(res);
	  		});
	  		return false;
		 });

		$(document).on("click",'#category_link', function on_category(e){
			 var category_value = $(this).attr('value');
			 var id = '#'+category_value;
			 $(id).css("background-color", "red");
			 $(id).siblings().css("background-color", "#006e0f");
			 $('#on-show-category').val(category_value);
			var href = $(this).attr('href');
			$.get(href+"/"+0, function(res){
				$('#product-display').html(res);	
			});
			return false;
		 });

		$(document).on("change", '#sort_selection', function(){
			var active_category = $('#on-show-category').val();
			var sort_selection = $('#sort_selection').val();
			if(sort_selection == 'default-selection'){
				if(active_category == 'all'){
					$.get('shops/display_user_product_data/0', function(res){
						$('#product-display').html(res);	
					});

				}
				else{
					$.get('shops/display/'+active_category+'/0', function(res){
						$('#product-display').html(res);	
					});
				}
			}
			else{
			$.get('shops/product_sort/'+active_category+'/'+sort_selection+"/0", function(res){
				$('#product-display').html(res);
			});
			}
		});

		$(document).on("click",'.pages', function(e){
			var active_category = $('#on-show-category').val();
			var href = $(this).attr('href');
			if(active_category != 'all'){
				$.get("/shops/display/"+active_category+"/"+href, function(res){
					$('#product-display').html(res);	
				});
			}
			else{
				$.get("/shops/display_user_product_data/"+href, function(res){
					$('#product-display').html(res);	
				});
			}
			return false;
		});
	});	    
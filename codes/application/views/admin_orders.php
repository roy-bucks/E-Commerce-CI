<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Admin Products</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css')?>">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>
<script>
$(document).ready(function(){
	$.get('shops/orders', function(res){
			$('#table').html(res);	
		});
	$(document).on("keyup", "#search_order", function(){
		var keyword = $(this).val();
		$.get('/shops/search_order/'+keyword, function(res){
		 	$('#table').html(res);
		 })
	});
	$(document).on("blur", "#search_order", function(){
		$.get('shops/orders', function(res){
			$('#table').html(res);	
		});
		
	});
});
</script>
<body>
<div class="admin-container">
	<div class="admin-header">
		<li><a href="#">Dashboard</a></li>
		<li><a href="orders" style="color:#00ffdd">Orders</a></li>
		<li><a href="admin_view_products">Products</a></li>
		<li class="admin-destroy"><a href="/shops/destroy">Logoff</a></li>
	</div>
	<div class="main_content-container">
		<div class="order-table">
			<div class="search-box">
				<input id="search_order" type="text" name="search_order" placeholder="Search Order">
			</div>
				<div id="table"> </div>
		</div>
	</div>
	
</div>
</body>
</html>
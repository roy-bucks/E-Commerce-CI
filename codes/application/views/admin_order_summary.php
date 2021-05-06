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
	var order_id = $('#order_id').val();
	$.get('/view_order/'+order_id, function(res){
			$('#data').html(res);	
		});
});
</script>
<body>
<input type="hidden" id="order_id" value="<?=$order_id?>">
<div class="admin-container">
	<div class="admin-header">
		<li><a href="#">Dashboard</a></li>
		<li><a href="/orders" style="color:#00ffdd">Orders</a></li>
		<li><a href="/admin_view_products">Products</a></li>
		<li class="admin-destroy"><a href="/destroy">Logoff</a></li>
	</div>
	<div class="order-summary-container">
		<img src="/assets/img/cart.gif">
		<div id="data"></div>
		
	</div>
</div>
	
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Admin Products</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css')?>">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="/assets/script/admin_product.js"></script>
	
</head>
<body>
<div class="admin-container">
	<div class="admin-header">
		<li><a href="#">Dashboard</a></li>
		<li><a href="/orders">Orders</a></li>
		<li><a href="admin_view_products" style="color:#00ffdd">Products</a></li>
		<li class="admin-destroy"><a href="/destroy">Logoff</a></li>
	</div>
<div class="content-container">
	<div class="product-top-view">
		<form method="post" action="/shops/search_admin_products">
			<input class="search-bar" type="text" name="search" placeholder="Search">
		</form>
		<a href="upload_section" class="upload-products-link">Add New Products</a>
	</div>
	<div class="table-container">
		
		<div id="table"></div>
		
	</div>
</div>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css')?>">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="/assets/script/store_home.js"></script>
</head>
<body>
<div class="user-container">
	<div class="user-header">
		<li class="header-logo"><img src="/assets/img/cart.gif"></li>
		<li><a href="store_home">Mr_Bucks Shop</a></li>
		<li><a href="/check_out">Your Cart <span id="cart_value"></span></a></li>
		<li class="admin-destroy"><a href="/destroy">Logoff</a></li>
	</div>
	<div class="navigation-area">
		<form method="post" action="/shops/search_user_products/0">
			<input class="search-box" type="text" name="search" placeholder="Search">
		</form>
		<div class="category-section">
			<h3>Categories</h3>
			<div id="list"></div>
		</div>
	</div>
	<div class="show-area">
		<div class="sort-section">
			<label>Sorted By</label>
			<select id='sort_selection' name='sort_product'>
				<option value="default-selection">Select</option>
				<option value="name"> Name</option>
				<option value="price">Price</option>
				<option value="created_at">Date</option>
			</select>
			<input type="hidden" name="active_category" id="on-show-category">
		</div>
			<div id="product-display"></div>

	</div>



</div>
</body>
</html>
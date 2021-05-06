<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Display Product</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css')?>">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="/assets/script/display.js"></script>
</head>
<body>
<input type="hidden" id="product_id" value="<?=$product_id?>">
<div class="user-container">
	<div class="user-header">
		<li class="header-logo"><img src="/assets/img/cart.gif"></li>
		<li><a href="/store_home">Mr_Bucks Shop</a></li>
		<li><a class="cart" href="/check_out">Your Cart <span id="cart_value"></span></a></li>
		<li class="admin-destroy"><a href="/destroy">Logoff</a></li>
	</div>
	<div class="display-container">
		<a class="back-btn" href="/store_home"><img src="/assets/img/back.png"><span>Go Back</span></a>
		<div id="product_details"></div>
	</div>
</div>
</body>
</html>
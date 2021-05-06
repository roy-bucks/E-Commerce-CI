<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Upload Products</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css')?>">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="/assets/script/upload.js"></script>
</head>
<body>
<div class="admin-container">
	<div class="admin-header">
		<li><a href="#">Dashboard</a></li>
		<li><a href="/orders">Orders</a></li>
		<li><a href="/admin_view_products">Products</a></li>
		<li class="admin-destroy"><a href="/destroy">Logoff</a></li>
	</div>
	<div class="upload-section">
		<h5 class="upload-title">Upload New Product</h5>
		<form id="upload-form" method="post" action="/shops/upload_product"  enctype="multipart/form-data">
			<table>
				<tr>
					<td>Product Name</td>
					<td><input id="product_name" type="text" name="product_name"></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><input id="product_price" type="number" name="product_price"></td>
				</tr>
				<tr>
					<td>Quantity</td>
					<td><input id="product_qty" type="number" name="product_qty"></td>
				</tr>
				<tr>
					<td>Category</td>
					<td><select id="product_category" name="product_category">
						<option value="T-Shirt">T-shirt</option>
						<option value="Shoes">Shoes</option>
						<option value="Mugs">Mugs</option>
						<option value="Bags">Bags</option>
						<option value="Key-Chain">Key Chain</option>
						<option class="Hats">Hats</option>
					</select></td>
				</tr>
				<tr>
					<td>Desciption</td>
					<td><textarea id="product_description" class="description-box" name="product_description"></textarea></td>
					
				</tr>
				<tr>
					<td>Images</td>
					<td><input id="product_image" type="file"  name="userfile[]" multiple></td>
				</tr>
			</table>
			<input class="upload-btn" type="submit" name="send" value="Upload">
		</form>
	</div>
	<div class="preview-section">
		<h5 class="preview-title">Upload Preview</h5>
		<div class="product-bcg-info">
			<div id="title"></div>
			<div id="loader"></div>
			<div id="img-preview"></div>
			<div class="inner-info">
				<div id="category"></div>
				<div id="qty"></div>
				<div id ="price"></div>
			</div>
		</div>
		<div class="product-dsc-info">
			<div id="description"></div>
		</div>
	</div>
</div>
</body>
</html>
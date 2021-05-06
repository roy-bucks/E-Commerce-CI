
<?php  foreach($data as $value){ ?>

<div class="product-details">
	<img class="main-image" src="<?=$value['image1']?>">
	<img class="second-image center" src="<?=$value['image2']?>">
	<img class="second-image" src="<?=$value['image3']?>">
	<img class="second-image" src="<?=$value['image4']?>">
	<img class="second-image" src="<?=$value['image5']?>">

	<h4 class="product-name"><?=$value['name']?></h4>
	<h6 class="product-qty">Availablle Stocks: <?=$value['quantity'] ?></h6>
	<h4 class="product-price">$ <?=$value['price']?></h4>
</div>
<div class="product-deatils-col2">
	<p class="product-description"><?=$value['description']?></p>
	<a id="add_to_cart" href="#"><div class="add-to-cart"><img src="/assets/img/add-cart.gif"><span>Add To Cart</span></div></a>
	<a id="buy_now" href="/check_out"><div class="buy-now"><img src="/assets/img/buy-now.gif"><span>Buy Now</span></div></a>
</div>

<?php } 

?>
<div class="related-products">
	<h4>Related-Products</h4>
<?php foreach($related_data as $value){ ?>
	<div class="related-product-container">
		<a href="/display_product/<?=$value['id']?>">
			<div class="related-products-display">
				<img src="<?=$value['image2']?>"> 
				<h3 class="name"><?=$value['name']?></h3>
				<h3 class="price">$ <?=$value['price']?></h3>
			</div>
		</a>
	</div>
<?php } ?>
</div>	

<?php  foreach($data as $value){ ?>
<div class="bg-modal" id="modal">
		<div class="content-modal">
			<img src="<?=$value['image1']?>">
			<div class="product-details">
				<h3 class="name"><?=$value['name']?></h3>
				<h3 class="qty">available quantity: <?=$value['quantity']?></h3>
				<h3 class="price">Price: $<?=$value['price']?></h3>
			</div>
			<form method="post" action="#">
				<input id="order_qty"class="quantity-box" type="number" name="order-quantity" placeholder="Enter the Quantity">
				<input type="hidden" id="product_id" value="<?=intval($value['id'])?>">
				<a id="add_to_cart_direct" href="#">
					<div class="add-to-cart"><img src="/assets/img/add-cart.gif">
						<span>Add To Cart</span>
					</div>
				</a>
				<span id="close">+</span>
			</form>
		</div>
</div>	
<?php } ?>
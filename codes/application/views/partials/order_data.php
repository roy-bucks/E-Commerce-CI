<input id="total" type="hidden"  value="<?=$total?>">
<input id="user_id" type="hidden"  value="<?=$user_id?>">
<?php foreach ($data as $value) { ?>
<input id="order_id"type="hidden" value="<?=$value['order_id']?>">
<?php } ?>
	<div class="item-details">
			<table class="check-out-table">
				<tr>
					<th>Item</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Remove</th>
				</tr>
<?php 	foreach($data as $value){	?>
				<tr>
					<td><?=$value['order_name'] ?></td>
					<td>$ <?=$value['order_price'] ?></td>
					<td><?=$value['order_quantity']?><a href="#"> update</a></td>
					<td>$<?=$value['sub_total']?></td>
					<td><a href="/shops/delete_order/<?=$value['id']?>" id="delete_order"><img src="/assets/img/delete.png" class="delete-icon"></a></td>
				</tr>
<?php 	}	?>
			</table>
		</div>
		<div class="details">
			<img class="cart-logo" src="/assets/img/bill_logo.gif">
			<h4 class="total">Total -------- <span> $<?=$total?></span></h4>
			<a href="/store_home">
				<div  class="shopping">Continue Shopping</div> </a><br>
			<a id="check_out" href="#">
				<div class="check-out">Check Out</div>
			</a>
		</div>

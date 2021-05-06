 <?php $subtotal =0?>	
 	<h3 class="order-id">ORDER ID: <?=$order[0]['order_id']?></h3>
	<div class="customer-details">
		<div class="shipping-details">
				<h3 class="title">Customer Shipping Information</h3>
				<table>
					<tr>
						<td>Name</td>
						<td><?=$shipping[0]['first_name'].' '.$shipping[0]['last_name']?></td>
					</tr>
					<tr>
						<td>Addess</td>
						<td><?=$shipping[0]['address']?></td>
					</tr>
					<tr>
						<td>State</td>
						<td><?=$shipping[0]['state']?></td>
					</tr>
					<tr>
						<td>Zip</td>
						<td><?=$shipping[0]['zipcode']?></td>
					</tr>
			
				</table>
		</div>
		<hr>
		<div class="billing-details">
			<h3 class="title">Customer Billing Information</h3>
			<table>
				<tr>
					<td>Name</td>
					<td><?=$billing[0]['first_name'].' '.$billing[0]['last_name']?></td>
				</tr>
				<tr>
					<td>Addess</td>
					<td><?=$billing[0]['address']?></td>
				</tr>
				<tr>
					<td>State</td>
					<td><?=$billing[0]['state']?></td>
				</tr>
				<tr>
					<td>Zip</td>
					<td><?=$billing[0]['zipcode']?></td>
				</tr>
		
			</table>
		</div>
	</div>
	<div class="product-details">
		<div class="customer-orders">
			<h2 class="title">Item Details</h2>
			<table>
				<tr>
					<th>ID</th>
					<th>Item</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
<?php foreach($order as $value){
	$subtotal += $value['total'];
	?>
				<tr>
					<td><?=$value['cart_id']?></td>
					<td><?=$value['order_name'] ?></td>
					<td>$ <?=$value['order_price']?></td>
					<td><?=$value['order_quantity'] ?></td>
					<td>$ <?=$value['total']?></td>
<?php } ?> 
			</table>
		</div>
		<div class="item-invoice">
			<h3 class="title">Bill Summary</h3>
			<hr>
			<table>
				<tr>
					<td>Status</td>
					<td>- - - - - -  - - - - - - -- -- -  </td>
					<td class="status"><?=$order[0]['status']?></td>
				</tr>

				<tr>
					<td>Sub Total</td>
					<td>- - - - - -  - - - - - - -- -- -  </td>
					<td>$ <?=$subtotal?></td>
				</tr>
				<tr>
					<td>Shipping Fee</td>
					<td>- - - - - -  - - - - - - -- -- -  </td>
					<td>$100</td>
				</tr>
				<tr>
					<td>Total</td>
					<td>- - - - - -  - - - - - - -- -- -  </td>
					<td>$ <?=$subtotal+100?></td>
				</tr>
			</table>
		</div>
	</div>	
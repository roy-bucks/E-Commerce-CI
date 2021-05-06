<table>
			<tr>
				<th>Order_Id</th>
				<th>Customer Name</th>
				<th>Date</th>
				<th>Billing Address</th>
				<th>Total</th>
				<th>Status</th>
			</tr>
<?php foreach($data as $value){ ?>
			<tr>
				<td><a href="order_summary/<?=$value['id']?>"><?=$value['id']?></a></td>
				<td><?=$value['customer_name']?></td>
				<td><?=date('Y-m-d H:i:s',strtotime($value['order_date']))?></td>
				<td><?=$value['address']?></td>
				<td><?=$value['total']?></td>
				<td><span class="paid-color"><?=$value['status']?></span></td>
			</tr>
<?php } ?>

		</table>
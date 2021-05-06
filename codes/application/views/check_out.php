<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css')?>">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="/assets/script/check_out.js"></script>
</head>
<body>
<div class="user-container">
	<div class="user-header">
		<li class="header-logo"><img src="/assets/img/cart.gif"></li>
		<li><a href="/store_home">Mr_Bucks Shop</a></li>
		<li class="admin-destroy cart-destroy"><a href="/destroy">Logoff</a></li>
	</div>
	<div class="display-container">
		<div id="order_details"></div>
	</div>
	<div class="cart">
		<div class="bg-modal" id="modal1">
			<div class="content-modal">
				<img src="assets/img/shipping.gif">
				<h4 class="title">Shipping Information</h4>
				<table class="information">
					<form id="shipping_info" method="post" action="/shops/shipping_details_json">
						<input type="hidden" name="order_id" id="order_id_main">
						<input type="hidden" name="user_id" id="user_id_main">
						<tr>
							<td>First Name</td>
							<td><input type="text" name="first_name"></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="last_name"></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" name="address"></td>
						</tr>
						<tr>
							<td>Address 2</td>
							<td><input type="text" name="address2"></td>
						</tr>
						<tr>
							<td>City</td>
							<td><input type="text" name="city"></td>
						</tr>
						<tr>
							<td>State</td>
							<td><input type="text" name="state"></td>
						</tr>
						<tr>
							<td>Zip Code</td>
							<td><input type="text" name="zip_code"></td>
						</tr>
					</form>
				</table>
				<span id="close">+</span>
				<input id="next_process" class="next" type="submit" value="Next">
			</div>
		</div>
		<div class="bg-modal" id="modal2">
			<div class="content-modal content-modal2">
				<img src="assets/img/bill_logo.gif">
				<h4 class="title">Billing Information</h4>

					<form id="billing_info" method="post" action="/shops/submit_billing_details">
						<input type="hidden" name="order_id" id="order_id_main">
						<input type="hidden" name="user_id" id="user_id_main">
						<input type="hidden" name="shipping_id" id="shipping_id_main">
						<div class="auto-fill">
							<input id="auto_fill" type="checkbox" name="auto-fill">
							<label>Same as Shipping</label>
						</div>

						<table class="billing-information">
							<tr>
								<td>First Name</td>
								<td><input id="first_name" type="text" name="first_name"></td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td><input id="last_name" type="text" name="last_name"></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><input id="address" type="text" name="address"></td>
							</tr>
							<tr>
								<td>Address 2</td>
								<td><input id="address2" type="text" name="address2"></td>
							</tr>
							<tr>
								<td>City</td>
								<td><input id="city" type="text" name="city"></td>
							</tr>
							<tr>
								<td>State</td>
								<td><input id="state" type="text" name="state"></td>
							</tr>
							<tr>
								<td>Zip Code</td>
								<td><input id="zip_code" type="text" name="zip_code"></td>
							</tr>
						</table>
						<div  class="card-details">
						<table>
								<tr>
									<td>Card</td>
									<td><input type="text" name="card_number"></td>
								</tr>
								<tr>
									<td>Security Code</td>
									<td><input type="text" name="card_number"></td>
								</tr>
								<tr>
									<td>Expiration</td>
									<td>
										<input class="expiration" type="text" name="exp-month" placeholder="(mm)">/
										<input class="expiration" type="text" name="exp-year" placeholder="(year)"> 
									</td>
								</tr>
						</table>
						</div>
					</form>
				<span id="close">+</span>
				<input id="check_out_process" class="pay" type="submit" value="Pay">
			</div>
		</div>
	</div>	
</div>
</body>
</html>
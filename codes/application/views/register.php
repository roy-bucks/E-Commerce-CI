<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
	<div class="register-container">
		<img class="cart-logo" src="assets/img/cart.gif">
		<label class="cart-label">Mr_Bucks Shop</label>
		<hr>
		<form class="register-form" method="post" action="/shops/save_account">
			<h3 class="register-text">Register</h3>
			<table>
				<tr>
					<td>First name</td>
					<td><input type="text" name="first_name"></td>
				</tr>
				<tr>
					<td>Last name</td>
					<td><input type="text" name="last_name"></td>
				</tr>
				<tr>
					<td>email</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>password</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>Confirm password</td>
					<td><input type="password" name="passconf"></td>	
				</tr>
			</table>
			<input class="signin-btn" type="submit" name="send" value="Register">
		</form>
		<a href="/" class="text-link"> Signin</a>
	</div>

</body>
</html>
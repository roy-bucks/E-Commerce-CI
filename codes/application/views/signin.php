<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Signin</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>

	<div class="signin-container">
		<img class="cart-logo" src="assets/img/cart.gif">
		<label class="cart-label">Mr_Bucks Shop</label>
		<hr>
		<form class="signin-form" method="post" action="signin_process">
			<h3 class="signin-text">Signin</h3>
			<table>
				<tr>
					<td>Email</td>
					<td><input class="signin-input-box" type="text" name="email"></td>
				</tr>
					<td>Password</td>
					<td><input class="signin-input-box" type="password" name="password"></td>
			</table>
			<input class="signin-btn" type="submit" name="send" value="Signin">
		</form>
		<p>No Account? <a href="register" class="text-link"> Register</a></p>
	</div>

</body>
</html>
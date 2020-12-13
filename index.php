<!DOCTYPE html>
<html>
<head>
	<title>e-voting</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<h1>E voting System</h1>
	<div class="parent">
		<div class="child1">
			<h2>Sign in</h2>
			<p class="text-danger">
			<?php 
				include("signinaction.php");
			?>
			</p>
			<form method="post">
				<div>
					<div><label>Username: </label><input type="text" class="input" name="username"></div>
				</div>
				<div>
					<div><label>password: </label><input type="password" class="input"  name="password"></div>
				</div>
				<div>
					<input class="btn btn-primary" type="submit" value="Signing" name="signin">
				</div>
			</form>
		</div>

		<div class="child2">
			<h1>Sign Up</h1>
			<form method="post" action="action.php">
				<table>
					<tr>
						<td><label>Username: </label> </td><td><input type="text" class="input"  name="username"></td>
					</tr>
					<tr>
						<td><label>Full Name: </label> </td><td><input type="text" class="input"  name="name"></td>
					</tr>
					<tr>
						<td><label>State: </label> </td><td><input type="text"  class="input" name="state"></td>
					</tr>
					<tr>
						<td><label>LGA: </label> </td><td><input type="text"  class="input" name="lga"></td>
					</tr>
					<tr>
						<td><label>password: </label></td><td><input type="password" class="input"  name="password"></td>
					</tr>
					<tr> 
						<td>&nbsp; </td><td><input type="submit" name="create_account" value="create"></td>
					</tr>
				</table>
		</form>
		</div>
	</div> <!-- parent -->
</body>
</html>
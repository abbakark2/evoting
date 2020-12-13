<?php 
	session_start();
	if(!isset($_SESSION['user'])){
		header("location:index.php");
	} ?>
<!DOCTYPE html>
<html>
<head>
	<title>poll</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">

</head>

<body>
	<h1>Poll page</h1>
	<h2>
		Name: <?php echo $_SESSION['name']; ?> &nbsp; 
		User: <?php echo $_SESSION['username']; ?> &nbsp; <a href="signout.php"> Signout</a></h2>
	<div class="container">
		<div class="card">
			<form method="post" action="voteaction.php">
				<div class="parent">
					<div style="flex: 1;" class="debug">
						<img src="pics/apc.jpg" class="partyIcon">
					</div>
					<div style="flex: 3;">
						<input type="hidden" name="party" value="boy">
						<input type="submit" value="vote" style="float: right;" class="btn btn-primary" name="btnvote">
					</div>
				</div>
				
			</form>
		</div>
		<div class="card">
			<form method="post" action="voteaction.php">
				<div class="parent">
					<div style="flex: 1;" class="debug">
						<img src="pics/id.jpg" class="partyIcon">
					</div>
					<div style="flex: 3;">
						<input type="hidden" name="party" value="boy">
						<input type="submit" value="vote" style="float: right;" class="btn btn-primary" name="btnvote">
					</div>
				</div>
				
			</form>
		</div>
	
</body>
</html>
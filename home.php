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
		<?php 
			include("dbconnection.php");
			$sql = "SELECT * FROM positions";
			$fetchQuery = mysqli_query($conn, $sql);
			if(!$fetchQuery) die("couldn't fetch positions").mysql_error($conn);

			foreach ($fetchQuery as $position) {
		?> 		<form method='post' action="voteaction.php">
					<div class='card'> 
						<div style="display: flex; justify-content: space-between;">
							<div style='flex:9' > <h3> Vote for <?php echo $position['position_name'] ?> </h3></div>
							<div style='flex:1;' > 
								<?php 
									echo "<input type='hidden' name='position' value='".$position['position_id']."'>";
								 ?>
								<input type="submit" name="btn_go" class='btn bg-success text-white' value="Go">
							</div>
						</div>
					</div>
				</form>
	<?php 	}
		 ?>
	</div>
	
</body>
</html>
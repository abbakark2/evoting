<?php 
	session_start();
	if(!isset($_SESSION['user'])){
		header("location:index.php");
	}
	if(!isset($_SESSION['position'])){
		header("location:home.php");
	} 
	$voter_id = $_SESSION['user'];
	$position = $_SESSION['position'];
?>
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
	?>
	
	<?php 
		
		$sql = "SELECT candidates.name, candidates.id_candidates, positions.position_name, positions.position_id FROM `candidates`
					JOIN positions
				    	ON candidates.position_id=positions.position_id
				    		WHERE positions.position_id = $position";

		$fetchQuery = mysqli_query($conn, $sql);
		if(!$fetchQuery) die("couldn't fetch positions").mysql_error($conn);

		foreach ($fetchQuery as $candidate) {
			$position_id = $candidate['position_id']; $candidate_id = $candidate['id_candidates'];
			$pos_cand_id = [$position_id, $candidate_id];

	 ?>
			<div class="card">
				<form method="post" action="voteaction.php">
					<div class="parent">
						<div style="flex: 1;">
							<img src="pics/apc.jpg" class="partyIcon">
						</div>
						<div style="flex: 3;">
							<?php 
							echo "<h2>".$candidate['name']."</h2>"; 

							foreach($pos_cand_id as $candidate_id_position_id){
							    echo '<input 
							    	type="hidden" 
							    	name="candidate_id_position_id[]" 
							    	value="'. $candidate_id_position_id. '">';
							}
							?>
							
							<input type="submit" value="vote" style="float: right;" class="btn btn-primary" name="btnvote">
						</div>
					</div>
				</form>
			</div>
	<?php } ?>
	
</body>
</html>
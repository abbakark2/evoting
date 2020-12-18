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
	<script type="text/javascript" src="jquery.js"></script>
	<style type="text/css">
		#vote_msg{
			position: fixed;
			z-index: 1;
			top:250px;
			right:250px;
		}
	</style>
</head>

<body>
	<h1>Poll page</h1>
	<h2>
		Name: <?php echo $_SESSION['name']; ?> &nbsp; 
		User: <?php echo $_SESSION['username']; ?> &nbsp; <a href="signout.php"> Signout</a></h2>
	<div class="container">
	<p id="vote_msg">
		<?php 
			include("dbconnection.php");
		?>
	</p>
	
	<script type="text/javascript">
		setTimeout(() => $("#vote_msg").text(""), 3000);
	</script>
	
	<?php 
		$msg = "";
		switch ($position) {
			case 1:
				$sql = "SELECT candidates.name, candidates.candidates_id, positions.position_name, positions.position_id FROM `candidates`
					JOIN positions
				    	ON candidates.position_id=positions.position_id
				    		WHERE positions.position_id = $position";
				break;
			
			default:
				$sql = "SELECT candidates.name, candidates.candidates_id, positions.position_name, positions.position_id FROM `candidates`
					JOIN positions
				    	ON candidates.position_id=positions.position_id
				    		WHERE positions.position_id = $position AND candidates.state='".$_SESSION['voter_state']."'";
				break;
		}


		$fetchQuery = mysqli_query($conn, $sql);
		
		if(!$fetchQuery) die("couldn't fetch positions").mysql_error($conn);



		$sqlGetVotedCandidateName = "SELECT tbl_votes.*, candidates.name FROM `tbl_votes`
			 JOIN candidates
		     	ON candidates.candidates_id = tbl_votes.candidates_id
		        	WHERE tbl_votes.voters_id = $voter_id and tbl_votes.position_id=$position";

		$QueryGetVotedCandidateName = mysqli_query($conn, $sqlGetVotedCandidateName);

		if(!$QueryGetVotedCandidateName) die("coudln't get candidate name query");

		$data = mysqli_fetch_array($QueryGetVotedCandidateName);
		$newCandidateName = $data['name'];

		$msg="you have voted for ".$data['name'];

		foreach ($fetchQuery as $candidate) {
			$position_id = $candidate['position_id']; 
			$candidate_id = $candidate['candidates_id'];
			$candidate_name = $candidate['name'];
			
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
							<input type="hidden" name="candidate_name" value="<?php echo $candidate_name ?>">
							
						<?php 
							if($newCandidateName !=""){
								echo "<span style='color:green; float: right'>".$msg." <button class='btn bg-primary text-white' disabled>Vote</button><span>";
							}else{ 
								?><input type="submit" value="vote" style="float: right;" class="btn btn-primary" name="btnvote">
						<?php	}
						 ?>
							
						</div>
					</div>
				</form>
			</div>
	<?php } ?>
	
</body>
</html>
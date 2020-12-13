<?php require_once("dbconnection.php"); ?>
<?php 
	if(isset($_POST['btn_go'])){
		session_start();
		$_SESSION['position'] = $_POST['position'];
		header("location:vote.php");
	}

	
	if (isset($_POST['btnvote'])) {

		session_start();
		$voter_id = $_SESSION['user'];
		$position_id=$_POST['candidate_id_position_id'][0];
		$candidate_id=$_POST['candidate_id_position_id'][1];

		$sql_check_vote = "SELECT * FROM `tbl_votes` WHERE voters_id=$voter_id AND position_id = $position_id";

		$vote_query = mysqli_query($conn, $sql_check_vote);
		if(!$vote_query) die("couldn't fetch vote_query").mysql_error($conn);

		$row = mysqli_num_rows($vote_query);
		if($row > 0){
			$data = mysqli_fetch_array($vote_query);
			echo "you have already voted";
	?> 		<a href="vote.php">Go back</a>
<?php 		die(); 
		}

	
		
		

		$sql = "UPDATE `candidates` SET votes=votes+1 WHERE id_candidates=$candidate_id AND position_id = $position_id";

		$updateQuery = mysqli_query($conn, $sql);
		if(!$updateQuery) die("couldn't update candidates").mysql_error($conn);

		$vote_sql ="INSERT INTO `tbl_votes` (voters_id, position_id) VALUES ($voter_id, $position_id)";

		$insertQuery = mysqli_query($conn, $vote_sql);
		if(!$insertQuery) die("couldn't insert votes").mysql_error($conn);

	}
?>
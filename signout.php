<?php 
	session_start();
	unset($_SESSION['user']);
	session_unset();
	header("location:index.php");
 ?>
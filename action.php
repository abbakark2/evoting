<?php 
include("dbconnection.php");

 ?>
<?php 

$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
 
function encryptthis($data, $key) {
	$encryption_key = base64_decode($key);
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
	return base64_encode($encrypted . '::' . $iv);
}

function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

?>


<?php
if (isset($_POST['create_account'])) {
	if(isset($_POST['password'])){
		$name = $_POST['name'];
		$state = $_POST['state'];
		$lga = $_POST['lga'];
		$password = $_POST['password'];
		$username = $_POST['username'];

		$pwd=$password;
		$encrypted_password=encryptthis($pwd, $key);



		// $insertsql = "INSERT INTO `voter` (`voter_id`, `name`, `state`, `lga`, `username`, `password`) VALUES (NULL, '$name', '$state', '$lga', $username', '$encrypted_password')";

		$sql = "INSERT INTO voter (name,state,lga,username,password) VALUES('$name','$state','$lga','$username','$encrypted_password')";

		$insert_query = mysqli_query($conn, $sql);

		if (!$insert_query) {
	  		die("insertion to the database failed: " . mysqli_connect_error());
		}else{
			echo "<p style='color:#0f0'> Account created successfully <a href='index.php'>signin</a></p>";
		}
	}

}
?>
<?php 
	if(isset($_POST['votes'])){
		$sql = "SELECT * FROM signin WHERE `id`=2";
		$fetchQuery = mysqli_query($conn, $sql);
		if(!$fetchQuery) die("couldn't fetch votes").mysql_error($conn);

		foreach ($fetchQuery as $dbkey) {
			echo "<p>".$dbkey['username']."</p>";
			echo "<p>".$dbkey['password']."</p>";
			echo "<p>Decrepted password = ".decryptthis($dbkey['password'], $key);;
		}
	}

 ?>


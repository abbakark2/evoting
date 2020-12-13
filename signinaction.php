<?php 
include("dbconnection.php");

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


if(isset($_POST['signin'])){
	if($_POST['username'] != "" && $_POST['password'] !=""){
		$username = $_POST['username'];
		$entered_password = $_POST['password'];
		


		$sql = "SELECT * FROM voter WHERE username='$username'";
		$fetchQuery = mysqli_query($conn, $sql);

		if(!$fetchQuery) die("couldn't fetch votes").mysql_error($conn);

		$rows = mysqli_num_rows($fetchQuery);

		if($rows>0){
			foreach ($fetchQuery as $dbkey) {
				$dbpassword = $dbkey['password'];
				$decrypted_password = decryptthis($dbpassword, $key);

				if($decrypted_password==$entered_password){
					$user = $dbkey['voter_id'];
					$username = $dbkey['username'];
					$name = $dbkey['name'];
					$status = 1;
					break;
				}
			}
			session_start();
			$_SESSION['user']=$user;
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $name;

			header("location:home.php");
		}else{
			echo "invalid username or password";
		}

	}else{
		echo "Please type in your username and password";
	}
}
?>
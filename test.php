<?php 

// $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
 
// function encryptthis($data, $key) {
// $encryption_key = base64_decode($key);
// $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
// $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
// return base64_encode($encrypted . '::' . $iv);
// }
 
// function decryptthis($data, $key) {
// $encryption_key = base64_decode($key);
// list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
// return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
// }
 
// if(isset($_POST['submit'])){
// $data=$_POST['foo'];
// $encrypted=encryptthis($data, $key);
// $decrypted=decryptthis($encrypted, $key);
// echo '<h2>Original Data</h2>';
// echo '<p>'.$data.'</p>';
// echo '<h2>Encrypted Data</h2>';
// echo '<pre>'.$encrypted.'</pre>';
// echo '<h2>Decrypted Data</h2>';
// echo '<p>'.$decrypted.'</p>';
// }
 
// echo '<form method="post">
// <input type="text" name="foo">
// <input type="submit" name="submit" value="submit">
// </form>';
	// $po = "president";
	// $id = 22;
	// $positionArray = [$po,$id];
	// array_push($positionArray, "girl");
	// print_r($positionArray);
$boy = "";
if(isset($_POST['btnvote'])){
	$boy = "fuch yeah";
	header("location:test.php?boy=$boy");
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>testing</title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="css/index.css">
 	<script type="text/javascript" src="jquery.js"></script>
	<style type="text/css">
		#vote_msg{
			position: fixed;
			top:200px;
			z-index: 1;
		}
	</style>
 </head>
 <body>	
	
	<div class="container bg-danger">
		<h1>main body</h1>
		<div class="bg-primary">
			<h2>second head</h2>
		</div>
	</div>
	<div class="card">
		<p>this is a  boy <?php echo isset($_GET['boy'])?$_GET['boy']:"not yet"; ?></p>
		<form method="post">
			<div class="parent">
				<div style="flex: 1;">
					<img src="pics/apc.jpg" class="partyIcon">
				</div>
				<div style="flex: 3;">
					<input type="hidden" name="candidate_name" value="<?php echo $candidate_name ?>">
					<p id="vote_msg">You have selected a president</p>
					<input type="submit" value="vote" style="float: right;" class="btn btn-primary" name="btnvote">
				</div>
			</div>
		</form>
		<button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
</button>

<button type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-ok"></span>
</button>
	</div>

	<!-- 		<p id="aljam">Hello, world</p>
 	<script type="text/javascript">
		setTimeout(() => {
			return($("#alam").text(""))
		}, 3000);
		
	</script> -->
 </body>
 </html>
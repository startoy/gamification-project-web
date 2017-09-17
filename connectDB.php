
<?php
$servername = "localhost";
$login_username = "root";
$login_password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $login_username, $login_password, $dbname);
mysqli_set_charset($conn,"utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
	# code...
	/*echo "Connection DB";*/
}
?>

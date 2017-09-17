<?php
session_start();
if($_POST&&isset($_POST['rusername'])) {
	$username = $_POST['rusername'];
	$password = $_POST['password']; //not encrypt
	$email = $_POST['e-mail'];
	$fname =  $_POST['firstname'];
	$lname = $_POST['lastname'];
	$bdate = $_POST['bdate'];
	$Bdate = date('Y-m-d',strtotime($bdate));
	$checkbox = $_POST['checkbox1'];
	if(isset($_POST['section_id'])){
		$secid =  $_POST['section_id'];
		$_SESSION['secid'] = $secid;
		$sql2 = "INSERT INTO account VALUES(
				'$username', '$password', '$email', '$fname', '$lname',
				'$Bdate' , '$secid', '$checkbox')";
	}else{
		$sql2 = "INSERT INTO account VALUES(
				'$username', '$password', '$email', '$fname', '$lname',
				'$Bdate' ,NULL, '$checkbox')";
	}

	$err = "";
	
	include "connectDB.php";
	
	//ตรวจสอบว่าว่า username และ password(ซ้ำกับผู้อื่นหรือไม่)
	$sql = "SELECT username FROM account WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		if($username == $row[0]) {
			$err = "Login: '$username' is duplicate, Please use another username ";
		}
	}
	
	 if($err == "") {
		if(!mysqli_query($conn, $sql2)) {
			$err = "There is an error, Please try again";
		}
	 }
	 
	 if($err != "") {
		echo "<script>alert('$err');</script>";
		echo mysqli_error($conn);
		mysqli_close($conn);
		exit;
	 }

	 $_SESSION['username'] = $username;
	 $_SESSION['acctype'] = $checkbox;

	echo "<script>
			alert('Save completed, Return to homepage in 2 second');
			setInterval(function() { location.href = 'home.php'; }, 2000);
			$('form')[0].reset();
		</script>";
		
	mysqli_close($conn);
	exit;
}
?>
<?php
session_start();
if($_POST) {

	$username = $_POST['rusername'];
	$password = $_POST['password'];
	$email = $_POST['e-mail'];
	$fname =  $_POST['firstname'];
	$lname = $_POST['lastname'];
	$bdate = $_POST['bdate'];
	$Bdate = date('Y-m-d',strtotime($bdate));
	$checkbox = $_POST['checkbox1'];
	if(isset($_POST['section_id'])){
		$secid =  $_POST['section_id'];
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
	
	//ตรวจสอบว่าว่า username และ password(รหัสประจำตัวซ้ำกับผู้อื่นหรือไม่)
	$sql = "SELECT username FROM account WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		if($username == $row[0]) {
			$err = "ล็อกอิน: $username ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม";
		}
	}
	
	 if($err == "") {
		
		
		if(!mysqli_query($conn, $sql2)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	 }
	 
	 if($err != "") {
		echo "<script>alert('$err');</script>";
		echo mysqli_error($conn);
		mysqli_close($conn);
		exit;

	 }

	echo "
	<script>
		setInterval(function() { location.href = 'editaccount.php'; }, 500);
		$('form')[0].reset();
		
		</script>";
		
	mysqli_close($conn);
	exit;
}
?>
<script type="text/javascript">
	alert('date='+$bdate);
</script>
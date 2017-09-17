<!DOCTYPE html>
<?php session_start();
include('connectDB.php');
//UPDATE SECTION
if(isset($_POST['upassword']))
{
	$rusername = $_POST['rusername'];
	$upassword = $_POST["upassword"];
	$firstname= $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["e-mail"];
	$bdate = $_POST["bdate"];
	// $sec= $_POST["sec"];

	
	$sql = "UPDATE account SET  password ='$upassword',E_mail = '$email', F_name = '$firstname', 
			L_name = '$lastname', Bdate = '$bdate'
			where username = '$rusername'
			";
	$result = mysqli_query($conn,$sql); //query add to table
	if(!$result) { echo mysqli_error($conn); 
	}else{
	      header("Location: profile-user.php");
      exit;
	}
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <link rel="stylesheet" href="stylesheet.css"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit-Profile</title> 

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->    
    <link href="custom-css/section_detail.css" rel="stylesheet" /> 
</head>
<!-- HEADER -->
<?php include('head.php'); ?> 
<!-- Profile ของ ผู้ใช้ทั่วไป -->
<body>
	<div class='container-fluid'>
		<div class="row"><?php include('menu.php'); ?></div>

		<!-- CONTENT HERE-->

	<div class="row" style="background:#EEDD82;text-align:center;">
		<article>
		<br>
		<p class="SecDetail"><span class="glyphicon glyphicon-pencil"></span> Edit-Profile</p>
		<div class="hrBottom"></div>
		<?php 
		// if(isset($_SESSION ['username'])){
			include("connectDB.php");
			$username = $_SESSION['username'];
			$sql2 = "SELECT * from account  where  username like '".$username."'  ";
			$result2 = mysqli_query ( $conn, $sql2 );
			$member=mysqli_fetch_array($result2,MYSQLI_ASSOC);
			 //$check=1;
		?>
<form action="edit-profile.php" method="post">
		<section style="text-align:left;">
			<div style="margin-left:5%;padding:10px;"><br>
				<div class="form-group row">
					  <label for="example-text-input" class="col-sm-2 control-label">Username :</label>
					  <div class="col-sm-4">
					    <input  type="text" class="form-control" id="username" placeholder="Username" 
					    value="<?=$member['username']?>" disabled>

					     <input  type="hidden" class="form-control" id="username" placeholder="Username" 
					    value="<?=$member['username']?>" 
					    name="rusername" pattern="\w{8,20}" title="กรุณาใส่ชื่อผู้ใช้ใหม่อีกครั้ง">

					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-search-input" class="col-sm-2 control-label">Password :</label>
					  <div class="col-sm-4">
					    <input  type="password" class="form-control" id="inputPassword3" placeholder="Password" name="upassword" 
					    value="<?=$member["password"]?>" 
                    pattern="\w{8,16}" title="กรุณาใส่รหัสผ่านใหม่อีกครั้ง" required>
					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-email-input" class="col-sm-2 control-label">E-mail :</label>
					  <div class="col-sm-4">
					    <input  type="text" class="form-control" id="email" placeholder="e-mail" name="e-mail" 
					    value="<?=$member["E_mail"]?>" 
                       pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z.]+" title="กรุณาใส่ e-mail ใหม่อีกครั้ง" required>
                       
					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-url-input" class="col-sm-2 control-label">Firstname :</label>
					  <div class="col-sm-4">
					    <input type="text" class="form-control" id="fname" placeholder="Firstname"  name="firstname" 
					    value="<?=$member["F_name"]?>" 
                 pattern="[a-zA-Z]{1,50}" title="กรุณาใส่ชื่อใหม่อีกครั้ง" required>
					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-tel-input" class="col-sm-2 control-label">Lastname :</label>
					  <div class="col-sm-4">
					    <input type="text" class="form-control" id="lname" placeholder="Lastname" name="lastname" 
					    value="<?=$member["L_name"]?>" 
                pattern="[a-zA-Z]{1,50}" title="กรุณาใส่นามสกุลใหม่อีกครั้ง" required>
					  </div>
					</div>
					<div class="form-group row">
					  <label for="Bdate" class="col-sm-2 control-label"><b>Date of birth :</b></label>
	                  <div div class="col-sm-4">
	                    <input class="form-control" id="meeting" type="date" name="bdate" value="<?=$member["Bdate"]?>" />
	                  </div>
					</div>
					<!-- <div class="form-group row hidden">
					  <label for="Bdate" class="col-sm-2 control-label"><b>Section :</b></label>
	                  <div div class="col-sm-4">
	                    <input class="form-control" id="meeting" type="text" name="sec" value="<?=$member["Sec_id"]?>" disabled/>
	                  </div>
					</div> -->
					<button type="submit" class="btn btn-warning" style="margin-left:30%;">Submit</button>						
			</div>
		</section>
</form> 
		</article>	
		<br>
		<br>
	</div>

<!-- END CONTENT-->

	</div>




<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</body>
</html>

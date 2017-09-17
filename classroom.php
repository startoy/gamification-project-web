<?php 
session_start();
include('connectDB.php');

//UPDATE SECTION
if(isset($_POST['section']))
{
	$section = $_POST["section"];
	$year= $_POST["year"];
	$description = $_POST["description"];
	$sec_id = $_POST["secid"];
	console_log($sec_id);
	$sql = "UPDATE Section SET
			Sec = '".$section."',
			Year = '".$year."',
			Description= '".$description."'
			WHERE Sec_id = '".$sec_id."' 
			";
	$result = mysqli_query($conn,$sql); //query add to table
	
	//ADD STUDENT TO THIS SECTION
	if(isset($_FILES['fileCSV']) && $_FILES['fileCSV']['error'] != UPLOAD_ERR_NO_FILE){
			// START FILE PART
			move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV
			require("connectDB.php");
			mysqli_set_charset($conn, "utf8");
			$objCSV = fopen($_FILES["fileCSV"]["name"], "r");
			while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
					$tempName = explode(" ",$objArr[1]); // tempName[0] = firstname , tempName[1] = lastname --> split with " " (spacebar)
					$strSQL = "INSERT INTO account ";
					$strSQL .="(username,password,F_name,L_name,Sec_id,AccType_id) ";
					$strSQL .="VALUES ";
					$strSQL .="('".$objArr[0]."','".$objArr[0]."','".$tempName[0]."','".$tempName[1]."','".$sec_id."',2) ";
					mysqli_query($conn, "SET NAMES utf8");
					$objQuery = mysqli_query($conn,$strSQL);
			}
			fclose($objCSV);

			// echo "Upload & Import Done.";
	}
}

//DELETE SECTION (FROM $_GET alink)
if(isset($_GET['deletesec_id'])){
	$sec_id = $_GET['deletesec_id'];
	$sql = "UPDATE Section SET
			Active = 'N'
			WHERE Sec_id = '".$sec_id."'
			";
	$result = mysqli_query($conn,$sql); //query add to table
	$err = mysqli_error($conn);
	console_log($err);
}

//ADD SECTION
if(isset($_POST['AddSection']) && isset($_POST['AddYear']) && isset($_POST['AddDescription'])){
	$addsec = $_POST['AddSection'];
	$addyear = $_POST['AddYear'];
	$adddesc = $_POST['AddDescription'];

	$sql = "INSERT INTO Section(`Description`, `Active`, `Sec`, `Year`, `username`) 
					VALUES('$adddesc','Y','$addsec','$addyear','".$_SESSION['username']."')
				 ";
	$result1 = mysqli_query($conn,$sql)  or die(console_log(mysqli_error($conn))); //query add to table
	// console_log(mysqli_insert_id($conn));

	$sql2 = "INSERT INTO `managesection`(`Sec_id`, `username`) 
				VALUES ('".mysqli_insert_id($conn)."','".$_SESSION['username']."')
				";
	$result2 = mysqli_query($conn,$sql2)  or die(console_log(mysqli_error($conn))); //query add to table
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ClassRoom</title>

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->
<style>
.container{
	width: 80%;
}
.panel-default {
	background-color: #faf6eb;
	width: 100%;
}
.panel-title {
	background-color:#b3ae91;
	color: #4d4b4c;
	font-size: 15px;
}
.panel-heading {
	width: 100%;
	color: #b3ae91;
	font-size: 15px;
}
.form {

	width: 50%;
	color: #b3ae91;
	font-size: 15px;
	margin: auto;
}
.textAdd {
	float: left;
	color: white;
	display: inline-block;
	font-size: 10px;
}
.editClassRoom {
	background-color: #4d4b4c;
	color: #e7e9d3;
	padding: 10px 5px 10px 18px;
	width: 300px;
	margin: 0px 0px 0px 100px;
	font-size: 20px;
}

.hrBottom {
		border-bottom: 2px solid #4d4b4c;
		margin: 0px 75px 0px 75px;
}
.SecName {
	color: #4d4b4c;
	display: inline-block;
}

.iconD {
	width: 20px;
	float: right;
	margin: 0px 40px 0px 0px;
}

.iconU {
	width: 20px;
	float: right;
	margin: 0px 30px 0px 0px;
}

</style>
</head>
<!-- HEADER -->
<?php include('head.php'); ?> 

<body>
	<div class='container-fluid'>
<!-- if user, show this -->
<div class="row"><?php include('menu.php'); ?> <!-- NAVBAR'S USER --></div>
		<div class="row" style="background:#EEDD82;text-align:center;">
<article>
	<br>
		<p class="editClassRoom">EDIT CLASSROOM</p>
		<div class="hrBottom"></div>
	<!--<p class="addItem">+ ADD ITEM</p>-->
		<div class="container"
			 style="width: 350px; margin: 10px 200px 0px 600px;" >
		<div class="panel-group" id="accordion" >			
		<div class="panel panel-default" 
			 style="background-color:#9d472e; border: 0px solid #9d472e; width: 500px; margin: 10px 0px 0px 0px;">
		<div class="panel-heading" 
			 style="background-color:#9d472e; width: 90px; margin: 10px 300px 0px 0px;">
			<h4 class="panel-title" style="background-color:#9d472e;">
				<a data-toggle="collapse" data-parent="#accordion" href="#addSection1" style="color: #e7e9d3;">+ ADD
				</a>
			</h4>
		</div>
				<!--begin add-->
				<div id="addSection1" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="panel-heading">
							<form class="form-horizontal" action="classroom.php" method="post">
  <div class="form-group">
    <label for="inputSec" class="col-sm-3 control-label">Section</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputSec" placeholder="Section" name="AddSection">
    </div>
  </div>
  <div class="form-group">
    <label for="inputYear" class="col-sm-3 control-label">Year</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputYear" placeholder="Year" name="AddYear">
    </div>
  </div>
 <div class="form-group">
    <label for="inputDescription" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputDescription" placeholder="Description" name="AddDescription">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-1">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
						</div>
							</div>
					</div>
				</div>
				<!--end-->
			</div>
		</div>

<section>
<br>
	<div class="container">

		<div class="panel-group" id="accordion">	
<?php //begin loop php each item
		$sql="SELECT
						sec.*,
						msec.*
					FROM
						Section sec,
						managesection msec
					WHERE
						msec.username = '". $_SESSION['username']."' AND Active = 'Y' AND msec.Sec_id = sec.Sec_id
					ORDER BY
						`Sec`";
	$result = mysqli_query($conn,$sql);
	$idCount=0;
	while($row= mysqli_fetch_assoc($result)) 
	{ 
		$idCount++;
		$sec=$row["Sec"];
		$year=$row["Year"];
		$desc=$row["Description"];
	?>
		<!-- begin each item-->		
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#b3ae91;">
					<h4 class="panel-title">
						<div class="SecName">
						<a href="SecDetail.php?sec-id=<?php echo $row['Sec_id'] ?>">
						Section <?php echo $sec; ?>/ <?php echo $year; ?>
						</a>
						</div>
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $idCount; ?>">
						<img class="iconU" src="img/iconUpdate.png"></a>
						<a  href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='classroom.php?deletesec_id=<?php echo $row['Sec_id'];?>';}"><img class="iconD" src="img/iconDelete1.png" ></a>
						</div>
					</h4>



				<!-- update-->	
		<div id="collapse<?php echo $idCount; ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="panel-heading">
			<!--form action="update.php" method="POST"-->
			<div class="form">
						<form class="form-horizontal" action="classroom.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
  <div class="form-group">
    <label for="inputSec" class="col-sm-2 control-label">Section</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputSec" placeholder="Section" value="<?php echo $row["Sec"];?>" name="section">
    </div>
  </div>

  <input type="hidden" value="<?php echo $row['Sec_id'] ?>" name="secid">


  <div class="form-group">
    <label for="inputYear" class="col-sm-2 control-label">Year</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputYear" placeholder="Year" value="<?php echo $row["Year"];?>" name="year">
    </div>
  </div>
 <div class="form-group">
    <label for="inputDescribe" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDescribe" placeholder="Describe" value="<?php echo $row["Description"];?>" name="description">
    </div>
 </div>
 <div class="form-group">
    <label for="inputFile" class="col-sm-2 control-label">Student</label>
    <div class="col-sm-10">
      <input name="fileCSV" type="file" id="fileCSV" accept=".csv">
		<br><small> *support .csv with UTF-8 encoding file</small>
  </div>
  </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
 </div>	
 </div>
</form>
    </div>				
   </div>
  </div>
 </div>

<?php }?>
		</div>

	</div> <!-- end container -->

		</section>

<br><br><br><br><br><br><br><br>

				</div>  <!-- end background -->
				</article> <!-- end article  -->

		</div>
	</div> <!-- end container -->

</body>
<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</html>

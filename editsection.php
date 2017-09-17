<?php
session_start();
include('connectDB.php');

//ADD
if(isset($_POST['AddSection']) && isset($_POST['AddYear']) && isset($_POST['AddDescription'])){
  $addsec = $_POST['AddSection'];
  $addyear = $_POST['AddYear'];
  $adddesc = $_POST['AddDescription'];

  $sql = "INSERT INTO Section(`Description`, `Active`, `Sec`, `Year`, `username`) 
      VALUES('$adddesc','Y','$addsec','$addyear','".$_REQUEST['tname']."')
      ";
  $result = mysqli_query($conn,$sql); //query add to table
  $err = mysqli_error($conn);
  console_log($err);
}

//UPDATE
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
  $err = mysqli_error($conn);
  console_log($err);
  mysqli_close($conn);
  
  	//ADD STUDENT TO THIS SECTION
    // if(isset($_FILES['fileCSV']) || $_FILES['fileCSV']['error'] != UPLOAD_ERR_NO_FILE){
        if(isset($_FILES['fileCSV']) && $_FILES['fileCSV']['error'] != UPLOAD_ERR_NO_FILE){
			// START FILE PART
			move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV
			require("connectDB.php");
			mysqli_set_charset($conn, "utf8");
			$objCSV = @fopen($_FILES["fileCSV"]["name"], "r");
			while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
					$tempName = explode(" ",$objArr[1]); // tempName[0] = firstname , tempName[1] = lastname --> split with " " (spacebar)
					$strSQL = "INSERT INTO account ";
					$strSQL .="(username,password,F_name,L_name,Sec_id,AccType_id) ";
					$strSQL .="VALUES ";
					$strSQL .="('".$objArr[0]."','".$objArr[0]."','".$tempName[0]."','".$tempName[1]."','".$sec_id."',2) ";
					mysqli_query($conn, "SET NAMES utf8");
					$objQuery = mysqli_query($conn,$strSQL);
			}
			@fclose($objCSV);

			// echo "Upload & Import Done.";
	}
}
//DELETE
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

//GETTING VIEW
if(isset($_REQUEST['tname'])){
  $editMode = '1';
  $tUsername = $_REQUEST['tname'];
}
function getNAME( $tUsername ){
  if(isset($tUsername)){
  require('connectDB.php');
  $sql = "SELECT F_name,L_name FROM account WHERE username = '$tUsername'";
  $result = mysqli_query($conn, $sql);
  $row= mysqli_fetch_assoc($result);
   $err = mysqli_error($conn);
  console_log($err);
  $reTNAME = "".$row['F_name']." ".$row['L_name']."";
  return $reTNAME;
  }else{return "";}
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
	<title>Admin - Manage Section</title>

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->
      <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
      <link rel="stylesheet" href="custom-css/css_addaccount.css">
      <style type="text/css">
        #custom-search-input{
    padding: 3px;
    border: solid 1px #E4E4E4;
    border-radius: 6px;
    background-color: #fff;
}

#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

#custom-search-input .glyphicon-search{
    font-size: 23px;
}

/* centered columns styles */
.row-centered {
    text-align:center;
}
.col-centered {
    display:inline-block;
    float:none;
    /* reset the text-align */
    text-align:left;
    /* inline-block space fix */
    margin-right:-4px;
}
.col-fixed {
    /* custom width */
    width:320px;
}

.col-fixedINCLUDE {
    /* custom width */
    width:60%;
}

      </style>
</head>
<!-- HEADER -->
<?php include('head.php'); ?> 

<body style="padding: 0px;background:#EEDD82;">
<!-- START CONTAINER -->
<div class='container-fluid'>
<!-- if user, show this -->
<div class="row"><?php include('menu-admin.php'); ?></div>
<!-- START ROW -->
<div class="row" style="background:#EEDD82;text-align:center;">

  <div class="container" style=""> <!-- start search -->
    <div class="row row-centered">
        <div class="col-xs-6 col-centered col-fixed">  <!-- start col-xs-6 -->
        <h2>Search..</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Enter teacher name" 
                            name="nameSearch" oninput="fetch_select(this.value);" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div> <!-- end col-xs-6 -->
    </div>
    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed">
        <br>
          <div id="sectionReply">
          </div>
          <br>
        </div>
    </div>
 
</div> <!-- end search -->

  <div class="col-xs-12 col-centered col-fixedINCLUDE">
      <!-- START INSERT EDIT SECTION PART -->
      <?php 
        if(isset($editMode)){
          if($editMode = '1'){
            include('editsection-include.php');
          }
        }else{
          echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        }
      ?>
      <!-- END INSERT EDIT SECTION PART -->
  </div>
</div> <!-- end ROW -->
</div> <!-- end container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function checksec_year(){

      if(document.getElementById("checkbox2").checked==false){
        document.getElementById("hidesec").hidden=true;
        //document.getElementById("hideyear").hidden=true;
      }else{
        document.getElementById("hidesec").hidden=false;
        //document.getElementById("hideyear").hidden=false;
      }
    }

function fetch_select(val)
  {
  
   $.ajax({
   type: 'post',
   url: 'returnNamesearch.php',
   data: {
    nameLike:val
   },
   success: function (response) {
    document.getElementById("sectionReply").innerHTML=response; 
   }
   });
  }
</script>
</body>
<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->

</html>

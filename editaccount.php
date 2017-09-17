<?php
session_start();
include('connectDB.php');
//UPDATE Account
if(isset($_POST['userid']))
{
	$userid = $_POST["userid"];
	$username = $_POST["username"];
	$password= $_POST["password"];
	$fname = $_POST["F_name"];
	$lname = $_POST["L_name"];
	$email = $_POST["E_mail"];
	//console_log($username);
	$sql = "update account SET
			username = '".$username."',
			password= '".$password."',
			F_name = '".$fname."' ,
			L_name = '".$lname."',
			E_mail = '".$email."'
			WHERE username= '".$userid."'
			";
	$result = mysqli_query($conn,$sql); //query add to table
	$err = mysqli_error($conn);
	console_log($err);
}

if(isset($_GET['deleteusername'])){
	$username = $_GET['deleteusername'];
	//console_log($username);
	$sql = "DELETE FROM `account` WHERE
			username = '".$username."'
			";
	$result = mysqli_query($conn,$sql); //query add to table
	$err = mysqli_error($conn);
	console_log($err);
}

//ADD Account
// if(isset($_POST['AddUsername']) && isset($_POST['AddPassword'])){
// 	$addusername = $_POST['AddUsername'];
// 	$addpassword = $_POST['AddPassword'];

// 	$sql = "INSERT INTO Account(`username`, `password') 
// 			VALUES('$addusername','$addpassword')
// 			";
// 	$result = mysqli_query($conn,$sql); //query add to table
// }

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
	<title>Account</title>

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->
      <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
      <link rel="stylesheet" href="custom-css/css_addaccount.css">
</head>
<!-- HEADER -->
<?php include('head.php'); ?> 

<body style="padding: 0px;">
	<div class='container-fluid'>
<!-- if user, show this -->
<div class="row"><?php include('menu-admin.php'); ?> <!-- NAVBAR'S USER --></div>
		<div class="row" style="background:#EEDD82;text-align:center;">
<article>
		<br>
		<p class="editClassRoom">MANAGE ACCOUNT</p>
		<div class="hrBottom"></div>

			<!--<p class="addItem">+ ADD ITEM</p>-->
<br>
		<div class="panel-heading" 
			 style="background-color:#9d472e; width: 90px; margin: 10px 300px 0px 0900px;">
			<h4 class="panel-title" style="background-color:#9d472e;">
				<a data-toggle="collapse" data-parent="#accordion" href="#" style="color: #e7e9d3;" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">+ ADD
				</a>
			</h4>
		</div>
				<!--begin add-->
    <div id="id02" class="modal1">      
      <form class="modal1-content animate form-horizontal" action="adduser.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal1">&times;</span>

        </div>
          <h3 class="h3">Add user</h3><br>
            
            <div class="form-group">
            <table border="0" align="center">
                <tr>
                  <td><label for="username" class="control-label"><b>Username</b></label></td>
                  <div class="col-sm-4">
                    <td><input type="text" class="form-control" id="username" placeholder="Username" name="rusername" 
                          pattern="{8,40}" title="Please input username again" required></td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
                </tr>
                <tr>
                <td ><label for="inputPassword" class="control-label"><b>Password</b></label></td>
                  <div class="col-sm-4">
                    <td><input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" 
                    pattern="\w{8,16}" title="Please input password again" required></td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
               </tr>                
                <tr>
                <td><label for="inputPassword1" class="control-label"><b>Confirm Password&nbsp;&nbsp;&nbsp;</b></label></td>
                  <div class="col-sm-4">
                    <td><input type="password" class="form-control" id="inputPassword3" placeholder="Password" 
                    pattern="\w{8,16}" title="Please input password again" required></td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td><label for="email" class="control-label "><b>E<span>-</span>mail</b></label></td>
                  <div class="col-sm-4">
                    <td>    <input type="text" class="form-control" id="email" placeholder="e-mail" name="e-mail" 
                       pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z.]+" title="Please input E-Mail again" required></td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
               </tr>                
                <tr>
                  <td><label for="Firstname" class="control-label"><b>Firstname</b></label></td>
                  <div class="col-sm-4">
                    <td>    <input type="text" class="form-control" id="fname" placeholder="Firstname"  name="firstname" 
                 pattern="\D{1,50}" title="Please input First Name again" required></td>
                  </div>  
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
                </tr>                
                <tr>
                  <td><label for="Lastname" class="control-label"><b>Lastname</b></label></td>
                  <div class="col-sm-4">
                    <td>    <input type="text" class="form-control" id="lname" placeholder="Lastname" name="lastname" 
                pattern="\D{1,50}" title="Please input Last Name again" required> </td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
                </tr>                
                <tr>
                  <td><label for="Bdate" class="control-label"><b>Date of birth</b></label></td>
                  <div class="col-sm-4">
                  <td>
                    <input id="meeting" class="form-control" type="date" name="bdate" />
                  </td>
                    <!-- <td>    <input type="text" class="form-control" id="Birht day" placeholder="01/10/1995" name="bdate" 
                pattern="\d{2}/\d{2}\/\d{4}" title="กรุณาใส่วันเกิดใหม่อีกครั้ง" required> </td> -->
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
                </tr>                
                <tr>
                  <td><label for="checkbox" class="control-label" name="checkbox1"><b>Type</b></label></td>
                  <div class="col-sm-4">
                    <td>
                        <input type="radio" class="" id="checkbox1" value="1"  name="checkbox1" onclick="checksec_year()" required>Member &nbsp;
                        <input type="radio" class="" id="checkbox2" value="2" name="checkbox1" onclick="checksec_year()" required>Student
                        &nbsp;
                        <input type="radio" class="" id="checkbox3" value="3"  name ="checkbox1" onclick="checksec_year()" required>Teacher
                    </td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
                </tr>                
                  <tr hidden="true" id ="hidesec">
                  <td></td>
                    <td>
                    <select onchange="fetch_select(this.value);" class="form-control">
                    <option> SELECT </option>
                      <?php  $sql2 = "SELECT username,F_name,L_name from account  where  AccType_id = '3'";
                          $result2 = mysqli_query ( $conn, $sql2 );
                          while ($row= mysqli_fetch_assoc($result2)) 
                          {
                            ?>
                              <option value='<?php echo $row['username']; ?>' >
                              <?php echo $row['F_name']."  ".$row['L_name']; ?></option>
                            <?php
                          }
                    ?>
                    </select>                  
                     <div id="ajax_reply_div">
                       
                     </div>
                  </td>
                    </tr>

                
                </div>
          </table><br>


          <button type="submit" class="bbutton">OK</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="reset" class="bbutton">CANCEL</button>
          
        </div><br>
      </form>
    </div>
     <!-- END BLOCK REGISTER -->
				<!--end-->
<br><br>

		<div class="container"> 
		<div class="row">
		                                <div class="col-md-12">
                                    <div class="card">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#member" aria-controls="member" role="tab" data-toggle="tab">Member</a></li>
                                        <li role="presentation"><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Student</a></li>
                                        <li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">Teacher</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                    <!-- BEGIN MEMBER -->
                                    <div role="tabpanel" class="tab-pane active" id="member">
        <?php 
//begin loop php each item
$sql="SELECT * FROM account WHERE AccType_id = '1' ORDER BY `username`";
$result = mysqli_query($conn,$sql);
$idCount=0;
while($row= mysqli_fetch_assoc($result)) 
{ 
	$idCount++;
	$username = $row["username"];
	$password = $row["password"];
	$Fname = $row["F_name"];
	$Lname = $row["L_name"];
	$email = $row["E_mail"]

?>                                                                       
	<div class="container">

		<div class="panel-group" id="accordion">	

		<!-- begin each member-->		
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#b3ae91;">
          <h4 class="panel-title"  style="  text-align: left;padding-left: 30%;">
						<div class="SecName"><?php echo $username." : ".$Fname." ".$Lname; ?></div>
							<a data-toggle="collapse" data-parent="#accordion" href="#mcollapse<?php echo $idCount; ?>">
							<img class="iconU" src="img/iconUpdate.png"></a>
							<a  href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='editaccount.php?deleteusername=<?php echo $username;?>';}"><img class="iconD" src="img/iconDelete1.png" ></a>
				</div>
					</h4>

				<!-- update-->	
<div id="mcollapse<?php echo $idCount; ?>" class="panel-collapse collapse">
	<div class="panel-body">
		<div class="panel-heading">	<!--form action="update.php" method="POST"-->
			<div class="form">
			<form class="form-horizontal" action="editaccount.php" method="post">
				<div class="form-group">
					<label for="Username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="Username" placeholder="Username" name="username" value="<?php echo $row["username"];?>"  >
						<input type="hidden" class="form-control" id="Username" placeholder="Username" name="userid" value="<?php echo $row["username"];?>"  >
					</div>
				</div>
				<div class="form-group">
					<label for="Password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="Password" placeholder="Password" name="password" value="<?php echo $row["password"];?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="F_name" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="F_name" placeholder="First Name" name="F_name" value="<?php echo $row["F_name"];?>"  >
					</div>
				</div>
				<div class="form-group">
					<label for="L_name" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="L_name" placeholder="Last Name" name="L_name" value="<?php echo $row["L_name"];?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="E_mail" class="col-sm-2 control-label">E-mail</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="E-mail" placeholder="E-mail" name="E_mail" value="<?php echo $row["E_mail"];?>" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-1">
						<button type="submit" class="btn btn-default">Submit</button>
					</div>
				</div>	
				</div>
			</form>
			</div>	
		</div>
	</div>
</div>
			</div>
		</div>
		 <?php }?>
	</div> <!-- end container -->
	<!-- END MEMBER -->

										<!-- BEGIN STUDENT -->
                                        <div role="tabpanel" class="tab-pane" id="student">
                                        
<?php 
//begin loop php each item
$sql="SELECT * FROM account WHERE AccType_id = '2' ORDER BY `username`";
$result = mysqli_query($conn,$sql);
$idCount=0;
while($row= mysqli_fetch_assoc($result)) 
{ 
	$idCount++;
	$username = $row["username"];
	$Fname = $row["F_name"];
	$Lname = $row["L_name"];

?>                                                                       
	<div class="container">
		<div class="panel-group" id="accordion">	
		<!-- begin each member-->		
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#b3ae91;">
          <h4 class="panel-title"  style="  text-align: left;padding-left: 30%;">
					 <div class="SecName"><?php echo $username." : ".$Fname." ".$Lname; ?></div>
						<a data-toggle="collapse" data-parent="#accordion" href="#scollapse<?php echo $idCount; ?>">
						<img class="iconU" src="img/iconUpdate.png"></a>
						<a  href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='editaccount.php?deleteusername=<?php echo $username;?>';}"><img class="iconD" src="img/iconDelete1.png" ></a>
						</div>
					</h4>


				<!-- update-->	
		<div id="scollapse<?php echo $idCount; ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="panel-heading">
			<!--form action="update.php" method="POST"-->
			<div class="form">
						<form class="form-horizontal" action="editaccount.php" method="post">
  <div class="form-group">
    <label for="Username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Username" placeholder="Username" name="username" 
      name="username" value="<?php echo $row["username"];?>">
     <input type="hidden" class="form-control" id="Username" placeholder="Username" name="userid" 
     value="<?php echo $row["username"];?>"  >
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Password" placeholder="Password" name="password" value="<?php echo $row["password"];?>">
    </div>
  </div>
				<div class="form-group">
					<label for="F_name" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="F_name" placeholder="First Name" name="F_name" value="<?php echo $row["F_name"];?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="L_name" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="L_name" placeholder="Last Name" name="L_name" value="<?php echo $row["L_name"];?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="E_mail" class="col-sm-2 control-label">E-mail</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="E-mail" placeholder="E-mail" name="E_mail" value="<?php echo $row["E_mail"];?>" >
					</div>
				</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-1">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
 </div>	
 </div>
</form>
    </div>				
   </div>
  </div>
 </div>

		</div>
		 
	</div> <!-- end container -->
<?php }?>
                                        </div> <!-- END STUDENT -->

                                        <!-- BEGIN TEACHER -->
                                        <div role="tabpanel" class="tab-pane" id="teacher">
                                       <?php 
//begin loop php each item
$sql="SELECT * FROM account WHERE AccType_id = '3' ORDER BY `username`";
$result = mysqli_query($conn,$sql);
$idCount=0;
while($row= mysqli_fetch_assoc($result)) 
{ 
	$idCount++;
	$username = $row["username"];
	$Fname = $row["F_name"];
	$Lname = $row["L_name"];

?>                                                                       
	<div class="container">

		<div class="panel-group" id="accordion">	

		<!-- begin each member-->		
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#b3ae91;">
					<h4 class="panel-title"  style="  text-align: left;padding-left: 30%;">
<div class="SecName"><?php echo $username." : ".$Fname." ".$Lname; ?></div>
						<a data-toggle="collapse" data-parent="#accordion" href="#tcollapse<?php echo $idCount; ?>">
						<img class="iconU" src="img/iconUpdate.png"></a>
						<a  href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='editaccount.php?deleteusername=<?php echo $username;?>';}"><img class="iconD" src="img/iconDelete1.png" ></a>
						</div>
					</h4>

				<!-- update-->	
		<div id="tcollapse<?php echo $idCount; ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="panel-heading">
			<!--form action="update.php" method="POST"-->
			<div class="form">
						<form class="form-horizontal" action="editaccount.php" method="post">
  <div class="form-group">
    <label for="Username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Username" placeholder="Username" name="username" value="<?php echo $row["username"];?>" >
      <input type="hidden" class="form-control" name="userid" value="<?php echo $row["username"];?>"  >
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Password" placeholder="Password" name="password" value="<?php echo $row["password"];?>" >
    </div>
  </div>
				<div class="form-group">
					<label for="F_name" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="F_name" name="F_name" placeholder="First Name" value="<?php echo $row["F_name"];?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="L_name" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="L_name" name="L_name" placeholder="Last Name" value="<?php echo $row["L_name"];?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="E_mail" class="col-sm-2 control-label">E-mail</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="E-mail" placeholder="E-mail" name="E_mail" value="<?php echo $row["E_mail"];?>"  >
					</div>
				</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-1">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
 </div>	
 </div>
</form>
    </div>				
   </div>
  </div>
 </div>

		</div>

	</div> <!-- end container --> 
	<?php }?> 
     		                                  </div> <!-- END TEACHER -->
                                        
                                    </div> <!-- END Tab panes  -->
</div>
                                </div>
	</div>


<br><br><br><br>
				</div>  <!-- end background -->
				</article> <!-- end article  -->

		</div>
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
   url: 'returnSection.php',
   data: {
    teacher_username:val
   },
   success: function (response) {
    document.getElementById("ajax_reply_div").innerHTML=response; 
   }
   });
  }
</script>
</body>
<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->

</html>

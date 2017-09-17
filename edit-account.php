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
if(isset($_POST['AddUsername']) && isset($_POST['AddPassword'])){
	$addusername = $_POST['AddUsername'];
	$addpassword = $_POST['AddPassword'];

	$sql = "INSERT INTO Account(`username`, `password') 
			VALUES('$addusername','$addpassword')
			";
	$result = mysqli_query($conn,$sql); //query add to table
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
	<title>Account</title>

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

	width: 80%;
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
	.nav-tabs { border-bottom: 2px solid #DDD; padding-left: 40%; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; 
        left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

.card {background: #FAFAD2 none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
body{ background: #EDECEC; padding:50px}
</style>
</head>
<!-- HEADER -->
<?php include('head.php'); ?> 

<body>
	<div class='container-fluid'>
<!-- if user, show this -->
<div class="row"><?php include('menu-admin.php'); ?> <!-- NAVBAR'S USER --></div>
		<div class="row" style="background:#EEDD82;text-align:center;">
<article>
		<br>
		<p class="editClassRoom">EDIT ACCOUNT</p>
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
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse03" style="color: #e7e9d3;">+ ADD
				</a>
			</h4>
		</div>
				<!--begin add-->
				<div id="collapse03" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="panel-heading">
							<form class="form-horizontal">
  <div class="form-group">
    <label for="Uername" class="col-sm-2 control-label">Uername</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Uername" placeholder="Uername" name="AddUsername">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Password" placeholder="Password" name="AddPassword">
    </div>
  </div>
  <div class="form-group">
    <label for="E_mail" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="E_mail" placeholder="E-Mail" name="AddE_mail">
    </div>
  </div>
  <div class="form-group">
    <label for="First Name" class="col-sm-2 control-label">First Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="First Name" placeholder="First Name" name="AddFirstName">
    </div>
  </div>
  <div class="form-group">
    <label for="Last Name" class="col-sm-2 control-label">Last Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Last Name" placeholder="Last Name" name="AddLastName">
    </div>
  </div>
  <div class="form-group">
        <label for="checkbox" class="col-sm-2 control-label" name="checkbox1"><b>Type</b></label>
            <div class="col-sm-10">
                    
                        <input type="radio" class="" id="checkbox1" value="1"  name="checkbox1" onclick="checksec_year()" required>Member &nbsp;
                        <input type="radio" class="" id="checkbox2" value="2" name="checkbox1" onclick="checksec_year()" required>Student
                        &nbsp;
                        <input type="radio" class="" id="checkbox3" value="3"  name ="checkbox1" onclick="checksec_year()" required>Teacher
                    
            </div>
   </div>
   	<div hidden="true" id ="hidesec">
        <label for="Teacher" class="col-sm-2 control-label">Teacher</label>           
                    <div class="col-sm-10">
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
                     </div>
                     <br><br><br>
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
					<h4 class="panel-title">
						<div class="SecName"><?php echo $username; ?></div>
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
					<h4 class="panel-title">
						<div class="SecName"><?php echo $username; ?></div>
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
					<h4 class="panel-title">
						<div class="SecName"><?php echo $username; ?></div>
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

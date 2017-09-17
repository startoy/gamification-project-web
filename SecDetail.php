<!DOCTYPE html>
<?php
session_start();
INCLUDE('connectDB.php');
if(isset($_REQUEST['sec-id'])) {
	$username = $_SESSION['username'];
	$sec_id = $_REQUEST['sec-id'];
}

if(isset($_POST['selectTA'])&&isset($_REQUEST['sec-id'])){
	$usernameTA = $_POST['selectTA'];
	$sql = "INSERT INTO `managesection`(`Sec_id`, `username`) VALUES ('$sec_id','$usernameTA')
			";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn)); //query add to table
	$err = mysqli_error($conn);
}

if(isset($_POST['AddUsername']) && isset($_POST['AddPassword'])){
	$addusername = $_POST['AddUsername'];
	$addpassword = $_POST['AddPassword'];
	$addemail = $_POST['AddEmail'];
	$addfname = $_POST['AddFname'];
	$addlname = $_POST['AddLname'];
	$secid = $_REQUEST['sec-id'];
	$addbdate = date('Y-m-d',strtotime($_POST['AddBdate']));

	$sql = "INSERT INTO Account(`Username`, `Password`, `E_mail`, `F_name`
			, `L_name`, `Bdate` , `Sec_id`,`AccType_id`) 
			VALUES('$addusername','$addpassword','$addemail','$addfname','$addlname'
			,'$addbdate','$secid','2')
			";
	$result = mysqli_query($conn,$sql); //query add to table
	$err = mysqli_error($conn);
	if($err != NULL){
	alert_log($err);
	console_log($err);
	}
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
function alert_log( $data ){
  echo '<script>';
  echo 'alert('. json_encode( $data ) .')';
  echo '</script>';
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Section Detail</title>

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->

    <link href="custom-css/section_detail.css" rel="stylesheet" />   
 <script>
	function TogglePopUp(){
		var displayx = document.getElementById('popup-addTA');
		if(displayx.style.display == 'block'){
			displayx.style.display = 'none';
			// alert("to none");
		}else{
			displayx.style.display = 'block';
			// alert("to block");
		}
		// alert("hey");
	}
</script>
</head>
<!-- HEADER -->
<?php include('head.php'); ?>
<style>
	.nav-tabs { border-bottom: 2px solid #DDD; padding-left: 32%; }
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
body{ background: #EDECEC;}

#popup-addTA{
	display:none;
	position:absolute;
}

.tdFullName{
text-align:left;
font-size:16px;
}
</style> 

<body>
<div class='container-fluid'> <!-- START container -->
	<!-- if user, show this -->
	<div class="row"><?php include('menu.php'); ?> <!-- NAVBAR'S USER --></div>
	<div class="row" style="background:#EEDD82;text-align:center;">
		<article>
		<br>
		<p class="SecDetail">Section</p>
		<div class="hrBottom"></div>

		<section style="text-align:left;padding-left:28.5%;padding-top:1%;padding-bottom:1%;">
		<?php

		$sql0 = "SELECT username FROM Section WHERE Sec_id = '$sec_id'";
		$result0 = mysqli_query($conn,$sql0);
		$row0 = mysqli_fetch_assoc($result0);
		$usernameSec = $row0["username"];

			//$user =  $_REQUEST["username"];
			$sql="SELECT concat(acc.F_name,' ',acc.L_name) as TName,
							Sec,
							Year,
							Description 
				  FROM  Section sec,
  						account acc 
				  WHERE  sec.username='$usernameSec'
				  AND acc.username=sec.username AND sec.Sec_id = '$sec_id'";
			$result = mysqli_query($conn,$sql);
			$row= mysqli_fetch_assoc($result);
			$tname = $row["TName"];
			$sec = $row["Sec"];
			$year = $row["Year"];
			$desc = $row["Description"];
		?>

			<div class="pull-right" style="padding-right:0.5%;">
			<a data-toggle="collapse" data-parent="#accordion" href="">
			<button type="button" class="btn btn-warning"  onclick="TogglePopUp()">
			<span class="glyphicon glyphicon-pencil"></span> Add TA </button>
			</a>
			</div>
<!-- start -->
<div id="popup-addTA">
		<div class="container"
			 style="width: 500px;background-color:#9d472e;" >

		<form class="form-horizontal" action="SecDetail.php" method="post">
			<div class="form-group" style="margin:5% 0.5% 0.5% 0.5%;">
				<label for="selectTA" class="col-sm-3 control-label">Name</label>
					<div class="col-sm-9">
				<select id="selectTA" name="selectTA" class="form-control">
				<?php 
			$sqlTA="SELECT
					acc.`username` as username,
					CONCAT(`F_name`,
					' ',
					`L_name`) as name
					FROM
					`account` acc
					WHERE
					`AccType_id` = '3'
					AND acc.username NOT IN (select username from managesection where Sec_id = '$sec_id')
 				 ";
			$resultTA = mysqli_query($conn,$sqlTA);
			while($rowTA= mysqli_fetch_assoc($resultTA)) 
			{
				?>
				<option value="<?php echo $rowTA["username"]; ?>"><?php echo $rowTA["name"]; ?></option>
			<?php } ?>
				</select>
					</div>
			</div>

			<input type="hidden" name="sec-id" value='<?php echo $sec_id; ?>' />
<br>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-1">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		</form>
		</div>

</div>

<!--end-->
			<div style="">
			<p><b>Teacher : <?php echo $tname; ?></b><br></p>
			<p><b>Section : <?php echo $sec; ?></b><br></p>
			<p><b>Year : <?php echo $year; ?></b><br></p>
			<p><b>Describe : <?php if($desc==''){echo "-";}else{echo $desc;} ?></b><br></p>
			</div>
		</section>
		<br>
		<p class="SecDetail">Score</p>
		<div class="hrBottom"></div>
		<br><br>
	

		<div class="container"> 
		<div class="row">
		                                <div class="col-md-12">
                                    <div class="card">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#sumscore" aria-controls="sumscore" role="tab" data-toggle="tab">Summary</a></li>
                                        <li role="presentation" class=""><a href="#linklist" aria-controls="linklist" role="tab" data-toggle="tab">Link List</a></li>
                                        <li role="presentation"><a href="#tree" aria-controls="tree" role="tab" data-toggle="tab">Tree</a></li>
                                        <li role="presentation"><a href="#graph" aria-controls="graph" role="tab" data-toggle="tab">Graph</a></li>
                                        <li role="presentation"><a href="#sorting" aria-controls="sorting" role="tab" data-toggle="tab">Sorting</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="sumscore">

                                       <table id="racetimes" border="0">
			<tr id="firstrow">
				<th rowspan="2">Rank</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Full Name</th>
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT sum(`playhistory`.`Score`) AS Score , `account`.`username`, concat(`account`.`F_name`,'  ', `account`.`L_name`) as fullName, `account`.`Sec_id`,
		COUNT(CASE WHEN playhistory.Medal_id='1' THEN 1  END) As Gold ,
		COUNT(CASE WHEN playhistory.Medal_id='2' THEN 1  END) AS Silver,
		COUNT(CASE WHEN playhistory.Medal_id='3' THEN 1  END) AS Bronze
FROM `account`
LEFT JOIN `playhistory` ON `playhistory`.`username` = `account`.`username` 
WHERE (( `Sec_id` = $sec_id))
GROUP BY playhistory.username, `account`.`username`, `account`.`F_name`, `account`.`L_name`, `account`.`Sec_id`  
ORDER BY Score DESC,Gold DESC,Silver DESC,Bronze DESC";
$result = mysqli_query($conn,$sql);
$ranking = 0;
while($row= mysqli_fetch_assoc($result)) 
{
	$ranking++;
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
	$fullName=$row["fullName"];
?>
			<tr><td><?php echo $ranking; ?></td>
		<td><?php echo "<a href='profile-user.php?student=".$username."'>".$username."</a>"; ?></td>
		<td class="tdFullName"><?php echo "<a href='profile-user.php?student=".$username."'>".$fullName."</a>"; ?></td>
				<td><?php if($score!=NULL ||$score!=''){echo $score;}ELSE{ echo '0';} ?></td>
				<td><?php echo $gold; ?></td>
				<td><?php echo $silver; ?></td>
				<td><?php echo $bronze; ?></td>
			</tr>
<?php }?>

		</table>
                                        </div>                           
                                        <div role="tabpanel" class="tab-pane" id="linklist">

                                       <table id="racetimes" border="0">
			<tr id="firstrow">
				<th rowspan="2">Rank</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Full Name</th>
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT p.username, SUM(score) AS Score, concat(`ac`.`F_name`,'  ', `ac`.`L_name`) as fullName,
		COUNT(CASE WHEN p.Medal_id='1' THEN 1  END) As Gold ,
		COUNT(CASE WHEN p.Medal_id='2' THEN 1  END) AS Silver,
		COUNT(CASE WHEN p.Medal_id='3' THEN 1  END) AS Bronze
	FROM playhistory p,account ac
	WHERE p.Game_id = '1'
	AND p.username = ac.username
	AND ac.Sec_id='$sec_id'
	GROUP BY p.username
	ORDER BY Score DESC,Gold DESC,Silver DESC,Bronze DESC";
$result = mysqli_query($conn,$sql);
$ranking = 0;
while($row= mysqli_fetch_assoc($result)) 
{
	$ranking++;
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
	$fullName=$row["fullName"];
?>
			<tr><td><?php echo $ranking; ?></td>
		<td><?php echo "<a href='profile-user.php?student=".$username."'>".$username."</a>"; ?></td>
		<td class="tdFullName"><?php echo "<a href='profile-user.php?student=".$username."'>".$fullName."</a>"; ?></td>
				<td><?php if($score!=NULL ||$score!=''){echo $score;}ELSE{ echo '0';} ?></td>
				<td><?php echo $gold; ?></td>
				<td><?php echo $silver; ?></td>
				<td><?php echo $bronze; ?></td>
			</tr>
<?php }?>

		</table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="tree">
                                        	
                                        	<table id="racetimes" border="0">
			<tr id="firstrow">
				<th rowspan="2">Rank</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Full Name</th>
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT p.username, SUM(score) AS Score, concat(`ac`.`F_name`,'  ', `ac`.`L_name`) as fullName,
		COUNT(CASE WHEN p.Medal_id='1' THEN 1  END) As Gold ,
		COUNT(CASE WHEN p.Medal_id='2' THEN 1  END) AS Silver,
		COUNT(CASE WHEN p.Medal_id='3' THEN 1  END) AS Bronze
		FROM playhistory p,account ac
	WHERE p.Game_id = '2'
	AND p.username = ac.username
	AND ac.Sec_id='$sec_id'
	GROUP BY p.username
	ORDER BY Score DESC,Gold DESC,Silver DESC,Bronze DESC";
$result = mysqli_query($conn,$sql);
$ranking = 0;
while($row= mysqli_fetch_assoc($result)) 
{
	$ranking++;
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
	$fullName=$row["fullName"];
?>
			<tr><td><?php echo $ranking; ?></td>
				<td><?php echo "<a href='profile-user.php?student=".$username."'>".$username."</a>"; ?></td>
		<td class="tdFullName"><?php echo "<a href='profile-user.php?student=".$username."'>".$fullName."</a>"; ?></td>
				<td><?php echo $score; ?></td>
				<td><?php echo $gold; ?></td>
				<td><?php echo $silver; ?></td>
				<td><?php echo $bronze; ?></td>
			</tr>
<?php }?>

		</table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="graph">
                                        	<table id="racetimes" border="0">
			<tr id="firstrow">
				<th rowspan="2">Rank</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Full Name</th>
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT p.username, SUM(score) AS Score, concat(`ac`.`F_name`,'  ', `ac`.`L_name`) as fullName,
		COUNT(CASE WHEN p.Medal_id='1' THEN 1  END) As Gold ,
		COUNT(CASE WHEN p.Medal_id='2' THEN 1  END) AS Silver,
		COUNT(CASE WHEN p.Medal_id='3' THEN 1  END) AS Bronze
		FROM playhistory p,account ac
	WHERE p.Game_id = '3'
	AND p.username = ac.username
	AND ac.Sec_id='$sec_id'
	GROUP BY p.username
	ORDER BY Score DESC,Gold DESC,Silver DESC,Bronze DESC";
$result = mysqli_query($conn,$sql);
$ranking = 0;
while($row= mysqli_fetch_assoc($result)) 
{
	$ranking++;
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
	$fullName=$row["fullName"];
?>
			<tr><td><?php echo $ranking; ?></td>
				<td><?php echo "<a href='profile-user.php?student=".$username."'>".$username."</a>"; ?></td>
		<td class="tdFullName"><?php echo "<a href='profile-user.php?student=".$username."'>".$fullName."</a>"; ?></td>
				<td><?php echo $score; ?></td>
				<td><?php echo $gold; ?></td>
				<td><?php echo $silver; ?></td>
				<td><?php echo $bronze; ?></td>
			</tr>
<?php }?>

		</table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="sorting">
                                        	<table id="racetimes" border="0">
			<tr id="firstrow">
				<th rowspan="2">Rank</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Full Name</th>
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT p.username, SUM(score) AS Score, concat(`ac`.`F_name`,'  ', `ac`.`L_name`) as fullName,
		COUNT(CASE WHEN p.Medal_id='1' THEN 1  END) As Gold ,
		COUNT(CASE WHEN p.Medal_id='2' THEN 1  END) AS Silver,
		COUNT(CASE WHEN p.Medal_id='3' THEN 1  END) AS Bronze
		FROM playhistory p,account ac
	WHERE p.Game_id = '4'
	AND p.username = ac.username
	AND ac.Sec_id='$sec_id'
	GROUP BY p.username
	ORDER BY Score DESC,Gold DESC,Silver DESC,Bronze DESC";
$result = mysqli_query($conn,$sql);
$ranking = 0;
while($row= mysqli_fetch_assoc($result)) 
{
	$ranking++;
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
	$fullName=$row["fullName"];
?>
			<tr><td><?php echo $ranking; ?></td>
				<td><?php echo "<a href='profile-user.php?student=".$username."'>".$username."</a>"; ?></td>
		<td class="tdFullName"><?php echo "<a href='profile-user.php?student=".$username."'>".$fullName."</a>"; ?></td>
				<td><?php echo $score; ?></td>
				<td><?php echo $gold; ?></td>
				<td><?php echo $silver; ?></td>
				<td><?php echo $bronze; ?></td>
			</tr>
<?php }?>

		</table>
                                        </div>
                                    </div>
</div>
                                </div>
	</div>
<div>

		</article>	
	<!--<p class="addItem">+ ADD ITEM</p>-->
		<div class="container"
			 style="width: 350px; margin: 10px 200px 0px 420px;" >
		<div class="panel-group" id="accordion" >			
		<div class="panel panel-default" 
			 style="background-color:#9d472e; border: 0px solid #9d472e; width: 500px; margin: 10px 0px 0px 0px;">
		<div class="panel-heading" 
			 style="background-color:#9d472e; width: 500px; margin: 10px 300px 0px 0px;">
			<h4 class="panel-title" style="background-color:#9d472e;" >
				<a data-toggle="collapse" data-parent="#accordion" href="#addStudent" style="color: #e7e9d3;">+ ADD Student
				</a>
			</h4>
		</div>
				<!--begin add-->
				<div id="addStudent" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="panel-heading">
							<form class="form-horizontal" action="SecDetail.php" method="post">
  <div class="form-group">
    <label for="inputUsername" class="col-sm-3 control-label">Username</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputUsername" placeholder="Username" id="username" placeholder="Username" name="AddUsername" pattern="{8,40}" title="Please input username again" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword" name="AddPassword" placeholder="Password" pattern="\w{8,16}" title="Please input password again" required>
    </div>
  </div>
 <div class="form-group">
    <label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputEmail" name="AddEmail" placeholder="E-Mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z.]+" title="Please input E-Mail again" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputFname" class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputFname" name="AddFname" placeholder="First Name" pattern="\D{1,50}" title="Please input First Name again" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputLname" class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputLname" name="AddLname" placeholder="Last Name" pattern="\D{1,50}" title="Please input Last Name again" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputBdate" class="col-sm-3 control-label">Birth Date</label>
    <div class="col-sm-9">
      <input id="meeting" class="form-control"  type="date" name="AddBdate" />
       <input type="hidden" name="sec-id" value='<?php echo $sec_id; ?>' />
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
		<br>
		<br>
	</div>
</div> <!-- END container -->

</div>
</body>
<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->

</html>



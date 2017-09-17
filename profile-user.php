<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <link rel="stylesheet" href="stylesheet.css"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Profile</title> 

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->
    
    <link href="custom-css/section_detail.css" rel="stylesheet" /> 
    <style>
    	.img_medal{
    		max-height: 40px;
    	}
    </style>
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
		<p class="SecDetail">Profile</p>
		<div class="hrBottom"></div>
		<?php 
		// if(isset($_SESSION ['username'])){
			include("connectDB.php");
			if(isset($_REQUEST['student']))
			{
				//if Teacher request
			$username = $_REQUEST['student'];
			$sql2 = "SELECT `account`.*
					, `section`.`username` 'TName', `section`.`Sec`, `section`.`Year`
					FROM `account`
					LEFT JOIN `section` ON `account`.`Sec_id` = `section`.`Sec_id` 
					WHERE (( `account`.`username` like '".$username."' ))";
			// $sql2 = "SELECT * from account  where  username like '".$username."'";
			}else{
				//else if self request
			$username = $_SESSION['username'];
						$sql2 = "SELECT `account`.*
					, `section`.`username` 'TName', `section`.`Sec`, `section`.`Year`
					FROM `account`
					LEFT JOIN `section` ON `account`.`Sec_id` = `section`.`Sec_id` 
					WHERE (( `account`.`username` like '".$username."' ))";
			}
			
			$result2 = mysqli_query ( $conn, $sql2 );
			$member=mysqli_fetch_array($result2,MYSQLI_ASSOC);
			 //$check=1;
		?>

		</section>
		<section style="text-align:left;" style="margin-right:5%;padding-right:10px;">
		<br>
		<?php
		if(!isset($_REQUEST['student'])){
		?>
		<div class="pull-right" style="padding-right:0.5%;">
			<a href="edit-profile.php">
			<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span>Edit-Profile</button>
			</a>
		</div>
		<?php } 
		$dateB = strtotime($member["Bdate"]);
		$mysqldate = date( 'd M Y', $dateB );
		?>
			<div style="margin-left:5%;padding:10px;">
				
				<p><b>Username : </b><?=$member["username"]?></p>
				<p><b>Firts name : </b><?=$member["F_name"]?></p>
				<p><b>Last name : </b><?=$member["L_name"]?></p>
				
				<!-- <p><b>Password : </b><?=$member["password"]?></p> -->
				<p><b>E-mail : </b><?=$member["E_mail"]?></p>
				<p><b>Birth date  : </b><?=$mysqldate?></p>
				 <?php

					//fetch Teacher owner of section name by previous $member teacher suername
					$sql3 = "SELECT * from account  where  username like '".$member['TName']."'";
					$result3 = mysqli_query ( $conn, $sql3 );
					$resfetch=mysqli_fetch_array($result3,MYSQLI_ASSOC);

				 	if(isset($_REQUEST['student'])){
				 		printf("<p><b>Section : </b>".$member['Sec']." / ".$member['Year']." (".$resfetch['F_name']." ".$resfetch['L_name'].")</p>");
				 		//ถ้าอาจารย์เข้ามาดู
				 	}else {
				 		if($member["Sec_id"]!=null && $_SESSION['acctype']=='2'){
							// printf("<p><b>Teacher : </b>".$resfetch['F_name']."</p>");
							printf("<p><b>Section : </b>".$member['Sec']." / ".$member['Year']." (".$resfetch['F_name']." ".$resfetch['L_name'].")</p>");
							//ถ้าดูโปรไฟล์ตัวเอง
				 		}
				 	}
				 ?>
<!--			<p><b>Type : </b><?=$member["type"]?></p>				
				<p><b>Year : </b><?=$member["year"]?></p>
				<p><b>Teacher : </b><?=$member["teacher"]?></p>
				<p><b>Major : </b><?=$member["major"]?></p>
				<p><b>Faculty : </b><?=$member["faculty"]?></p> -->
			</div>
		</section> 

		<br>
		<p class="SecDetail">Play History</p>
		<div class="hrBottom"></div>
		<br><br>

		<table id="racetimes" border="0">
			<tr id="firstrow">
			<!-- 
				ลำดับ เรียงตามวันที่ล่าสุด
			 -->
				<th rowspan="1">Order</th> 
				<th rowspan="1">Game's name</th>
				<th rowspan="1">Score</th>
				<th rowspan="1">Medal</th>
				<th rowspan="1">Date</th>
			</tr>
<!-- 			
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
 -->

 		<?php 
 		if(isset($_REQUEST['student']))
			{
			$sql=" select distinct * from playhistory p,subgame s, level_subgame l	,game g 
					WHERE username='".$_REQUEST['student']."'
					AND s.SubG_id = p.SubG_id
					AND l.Level_id = p.Level_id
					AND g.Game_id = p.Game_id
					AND s.SubG_id = l.SubG_id
					AND s.Game_id = g.Game_id
					AND g.Game_id = l.Game_id
					Order BY Upd_date desc LIMIT 10
			";
			} else {
			$sql=" select distinct * from playhistory p,subgame s, level_subgame l	,game g
					WHERE username='".$_SESSION['username']."'
					AND s.SubG_id = p.SubG_id
					AND l.Level_id = p.Level_id
					AND g.Game_id = p.Game_id
					AND s.SubG_id = l.SubG_id
					AND s.Game_id = g.Game_id
					AND g.Game_id = l.Game_id
					Order BY Upd_date desc LIMIT 10
			";
		}
			$result = mysqli_query($conn,$sql);
			$ranking = 0;
			while($row= mysqli_fetch_assoc($result)) 
			{
				$ranking++;

				$dateB = strtotime($row["Upd_date"]);
				$bdate = date( 'd M Y H:i:s', $dateB );
				$score=$row["Score"];
				$medalid=$row["Medal_id"];
				$subgname=$row["SubG_name"];
				$levelgname=$row["Level_name"];	
 		?>
			 <tr> 
				<td ><?php echo $ranking; ?></td>
				<td><?php echo $subgname.'('.$levelgname.')' ?></td>
				<td><?php echo $score; ?></td>
				<td><?php if ($medalid ==1){
					echo '<img src=img/medal_gold.png>';
				}elseif ($medalid==2) {
					echo '<img src=img/medal_silver.png>';
				}elseif ($medalid==3) {
					echo '<img src=img/medal_bronze.png>';
				}
				?></td>
				<td><?php echo $bdate; ?></td>
			</tr>
		<?php
			}
		?>
<!-- 			<tr>
				<td>1</td>
				<td>Queue-2</td>
				<td>300</td>
				<td><img src="img/medal_gold.png" alt="Gold" class="img_medal"></td>
				<td>21/11/2016 16:46:30</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Inorder-2</td>
				<td>120</td>
				<td><img src="img/medal_gold.png" alt="Gold" class="img_medal"></td>
				<td>14/11/2016 10:01:31</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Postorder-2</td>
				<td>100</td>
				<td><img src="img/medal_silver.png" alt="Silver" class="img_medal"></td>
				<td>04/11/2016 20:37:13</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Stack-2</td>
				<td>40</td>
				<td><img src="img/medal_bronze.png" alt="Bronze" class="img_medal"></td>
				<td>29/10/2016 13:20:11</td>
			</tr> -->
		</table>
		</article>	
<!-- 		<div class="btn-group" role="group">
			<a href="section-addStd.php" target="_blank"><button type="button" class="btn btn-default">Add Student</button></a>
		</div> -->
		<br>
		<br>
	</div>

<!-- END CONTENT-->

	</div>

<!-- 	<center>
	<div  class="bg">
		<table>
			<tr>
				<td><b></b></td>
				<td>&nbsp;&nbsp;สุณิชา</td>
			</tr>
			<tr>
				<td><b>Last name : </b></td>
				<td>&nbsp;&nbsp;แสงสุรินทร์</td>
			</tr>
			<tr>
				<td><b>Birth day : </b></td>
				<td>&nbsp;&nbsp;10/01/2538</td>
			</tr>
			<tr>
				<td><b>E-mail : </b></td>
				<td>&nbsp;&nbsp;sunicha.ss@hotmail.com</td>
			</tr>
			<tr>
				<td><b>รางวัล : </b></td>
				<td>&nbsp;&nbsp;<span class="glyphicon glyphicon-king" aria-hidden="true"></span></td>
			</tr>
		</table>	
	</div>
	</center> -->
 


<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</body>
</html>

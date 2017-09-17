<!DOCTYPE html>
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
 
</head>
<!-- HEADER -->
<?php include('head.php'); ?>
<style>
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

<body>
<div class='container-fluid'> <!-- START container -->
	<!-- if user, show this -->
	<div class="row"><?php include('menu.php'); ?> <!-- NAVBAR'S USER --></div>
	<div class="row" style="background:#EEDD82;text-align:center;">
		<article>
		<br>
		<p class="SecDetail">Section</p>
		<div class="hrBottom"></div>
		<section>
		<?php
			//$user =  $_REQUEST["username"];
			$sql="SELECT Sec, Year, Description FROM Section WHERE username='A.Theerayut'";
			$result = mysqli_query($conn,$sql);
			$row= mysqli_fetch_assoc($result);
			$sec = $row["Sec"];
			$year = $row["Year"];
			$desc = $row["Description"];
		?>
			<p><b>Section : <?php echo $sec; ?></b><br></p>
			<p><b>Year : <?php echo $year; ?></b><br></p>
			<p><b>Describe : <?php echo $desc; ?></b><br></p>
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
                                        <li role="presentation" class="active"><a href="#linklist" aria-controls="linklist" role="tab" data-toggle="tab">Link List</a></li>
                                        <li role="presentation"><a href="#tree" aria-controls="tree" role="tab" data-toggle="tab">Tree</a></li>
                                        <li role="presentation"><a href="#graph" aria-controls="graph" role="tab" data-toggle="tab">Grah</a></li>
                                        <li role="presentation"><a href="#sorting" aria-controls="sorting" role="tab" data-toggle="tab">Sorting</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="linklist">

                                       <table id="racetimes" border="0">
			<tr id="firstrow">
				<th rowspan="2">Rank</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT username, SUM(score) AS Score, 
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='1' AND Game_id = '1') As Gold ,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='2'  AND Game_id = '1') AS Silver,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='3'  AND Game_id = '1') AS Bronze
	FROM playhistory
	WHERE playhistory.Game_id = '1'
	GROUP BY username
	Order By score";
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
?>
			<tr><td><?php echo $ranking; ?></td>
				<td><?php echo $username; ?></td>
				<td><?php echo $score; ?></td>
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
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT username, SUM(score) AS Score, 
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='1' AND Game_id = '1') As Gold ,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='2'  AND Game_id = '1') AS Silver,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='3'  AND Game_id = '1') AS Bronze
	FROM playhistory
	WHERE playhistory.Game_id = '2'
	GROUP BY username
	Order By score";
$result = mysqli_query($conn,$sql);
while($row= mysqli_fetch_assoc($result)) 
{
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
?>
			<tr><td></td>
				<td><?php echo $username; ?></td>
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
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT username, SUM(score) AS Score, 
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='1' AND Game_id = '1') As Gold ,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='2'  AND Game_id = '1') AS Silver,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='3'  AND Game_id = '1') AS Bronze
	FROM playhistory
	WHERE playhistory.Game_id = '3'
	GROUP BY username
	Order By score";
$result = mysqli_query($conn,$sql);
while($row= mysqli_fetch_assoc($result)) 
{
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
?>
			<tr><td></td>
				<td><?php echo $username; ?></td>
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
				<th rowspan="2">Score</th>
				<th colspan="3">Medal</th>
			</tr>
			<tr id="firstrow" style="background: hsla(12, 100%, 40%, 0.5); ">
				<th><img src="img/medal_gold.png" alt="Gold"></th>
				<th><img src="img/medal_silver.png" alt="Silver"></th>
				<th><img src="img/medal_bronze.png" alt="Bronze"></th>
			</tr>
<?php //begin loop php each item
$sql="SELECT username, SUM(score) AS Score, 
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='1' AND Game_id = '1') As Gold ,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='2'  AND Game_id = '1') AS Silver,
		(SELECT COUNT(Medal_id) FROM playhistory WHERE Medal_id='3'  AND Game_id = '1') AS Bronze
	FROM playhistory
	WHERE playhistory.Game_id = '4'
	GROUP BY username
	Order By score";
$result = mysqli_query($conn,$sql);
while($row= mysqli_fetch_assoc($result)) 
{
	$username=$row["username"];
	$score=$row["Score"];
	$gold=$row["Gold"];
	$silver=$row["Silver"];
	$bronze=$row["Bronze"];	
?>
			<tr><td></td>
				<td><?php echo $username; ?></td>
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
		<div class="btn-group" role="group">
			<a href="section-addStd.php" target="_blank"><button type="button" class="btn btn-default">Add Student</button></a>
		</div>
		<br>
		<br>
	</div>
</div> <!-- END container -->


</body>
<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</html>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PROGRESS 1 - HOMEPAGE</title>

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->
    
</head>
<!-- HEADER -->
<?php include('head.php'); ?> 

<body>
	<div class='container-fluid'>
<!-- if user, show this -->
<div class="row"><?php include('menu.php'); ?> <!-- NAVBAR'S USER --></div>
		<div class="row" style="background:#EEDD82;text-align:center;">
			<img src="img/Loading.png">
			<br><br>
		</div>
	</div> <!-- end container -->
<!-- else -->
<!-- 	<div class='container-fluid'>
		<div class="row" style="background:red;">
			<h1>IF not USER</h1>
				NO PERMISSION -> PLEASE LOGIN 
		</div>
	</div> -->


<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</body>
</html>

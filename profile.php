<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>PROGRESS 1 - HOMEPAGE</title>

	<!-- Bootstrap -->
	<?php include('link_bootstrap_css.php'); ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<?php include('nav-top.php'); ?> <!-- HEADER MENU LOGIN -->

<body>
	<div class='container-fluid'>
<!-- if user, show this -->
<div class="row"><?php include('nav-user.php'); ?> <!-- NAVBAR'S USER --></div>
		<div class="row" style="background:lightgreen;text-align:center;">
			<h1>IF is USER</h1>
			<h2>CONTENT (ACHIEVEMENT)</h2>
			<img src="img/loading.jpg">
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
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->

<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</body>
</html>
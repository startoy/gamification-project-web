<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Student</title>

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

<body>
	<div class='container-fluid'> <!-- start container -->

		<div class="row"><?php include('menu.php'); ?> <!-- NAVBAR'S USER --></div>

		<div class="row" style="background:#EEDD82;text-align:center;">
			<!-- CONTENT -->
			<br>
			<p class="SecDetail">Add Student</p>
			<div class="hrBottom"></div>
<br>
					<div class="panel-body">
						<div class="panel-heading">
<form class="form-horizontal">
  <div class="form-group">
    <label for="Username" class="col-sm-5 control-label">Username</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="Username" placeholder="Input Username">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-5 control-label">Password</label>
    <div class="col-sm-3">
      <input type="password" class="form-control" id="Password" placeholder="Input Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-2">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div></div>
			<br><br><br><br><br><br><br>
		</div>

	</div> <!-- end container -->

<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</body>
</html>

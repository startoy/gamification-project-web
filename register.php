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
    <div class="row">
      <?php include('nav-user.php'); ?> <!-- NAVBAR'S USER -->
    </div>

<!--     <div class="row">
      <div class="col-md-1">1</div>
      <div class="col-md-1">1</div>
          <div class="col-md-1">1</div>
      <div class="col-md-1">1</div>
          <div class="col-md-1">1</div>
      <div class="col-md-1">1</div>
          <div class="col-md-1">1</div>
      <div class="col-md-1">1</div>
          <div class="col-md-1">1</div>
      <div class="col-md-1">1</div>
          <div class="col-md-1">1</div>
      <div class="col-md-1">1</div>
    </div> -->

    <form class="form-horizontal">
    <div class="form-group">
      <label for="username" class="col-sm-5 control-label">Username</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="username" placeholder="Username">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword3" class="col-sm-5 control-label">Password</label>
      <div class="col-sm-3">
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-5 control-label">E-mail</label>
      <div class="col-sm-3">
        <input type="email" class="form-control" id="email" placeholder="E-mail">
      </div>
    </div>
    <div class="form-group">
      <label for="fullname" class="col-sm-5 control-label">Full Name</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="fullname" placeholder="Full Name">
      </div>
    </div>
    <div class="form-group">
      <label for="studentid" class="col-sm-5 control-label">Student ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="studentid" placeholder="Student ID">
      </div>
    </div>
    <div class="form-group">
      <label for="Major" class="col-sm-5 control-label">Major</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="Major" placeholder="Major">
      </div>
    </div>
    <div class="form-group">
      <label for="Faculty" class="col-sm-5 control-label">Faculty</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="Faculty" placeholder="Faculty">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-6 col-sm-6">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
</form>

  </div> <!-- end container -->
<!-- else -->
<!--   <div class='container-fluid'>
    <div class="row" style="background:red;">
      <h1>IF USER login</h1>
        NO PERMISSION -> PLEASE LOGOUT 
    </div>
  </div> -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('link_bootstrap_js.php'); ?> <!-- js_bootstrap link -->

<?php include('footer.php'); ?> <!-- FOOTER CREDIT -->
</body>
</html>
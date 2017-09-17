<?php session_start();
include("connectDB.php");

//if session exist
if(isset($_SESSION['username'])){
	$tempUser = $_SESSION['username'];
	$sql = 'SELECT * FROM account WHERE username="'.$tempUser.'"';
	$result = mysqli_query($conn,$sql);
	$row= mysqli_fetch_assoc($result);
	$r = mysqli_num_rows($result);
	if($result) {
	    if($r==1){
	        $_SESSION['username'] = $tempUser;
	        $_SESSION['acctype'] = $row['AccType_id'];

        	if($row['AccType_id']=="2"){
            	$_SESSION['secid'] = $row['Sec_id'];
        	}

	        if($_SESSION['acctype']=='4'){
	        header("Location: editsection.php");
	        exit;
        }else{
	        header("Location: home.php");
	        exit;
      	}
    	}
    }
    mysqli_close($conn);
}

//if post from login
if(isset($_POST['username'])) {
  $msg = "";
  $username = $_POST['username'];
  $password = $_POST['password'];

  //
$sql = 'SELECT * FROM account WHERE username="'.$username.'" AND password="'.$password.'" ';
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_assoc($result);
    $r = mysqli_num_rows($result);
    if($result) {
      if($r==1){
        
        $_SESSION['username'] = $username;
        $_SESSION['acctype'] = $row['AccType_id'];
        if($row['AccType_id']=="2"){
           $_SESSION['secid'] = $row['Sec_id'];
        }

        if($_SESSION['acctype']=='4'){
        header("Location: editsection.php");
        exit;
        }else{
        header("Location: home.php");
        exit;
      }
            // echo "
      //        <script>
      //       alert('จัดเก็บข้อมูลแล้ว จะกลับสู่หน้าหลักใน 2 วินาที ".$_SESSION['acctype']."');
      //       setInterval(function() { location.href = 'home.php'; }, 6000);
      //       $('form')[0].reset();
            
      //       </script>
      //       ";
    }
    }
    else { 
      $msg = "กรุณากรอกชื่อผู้ใช้และรหัสผ่านให้ถูกต้อง";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <link rel="stylesheet" href="stylesheet.css"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>-->
          <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
          <script>
              webshims.setOptions('forms-ext', {types: 'date'});
          webshims.polyfill('forms forms-ext');
          </script>
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">



</head>
<title>HOME PAGE</title>
<!-- หน้าแรก -->
<body>
<div align="center"><br><br>
	<img src="img/indexs.png" width="1100px" height="600px"><br><br>
    <a href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><img src="img/blogin.png" width="150px" height="50px"></a>
	
  <!-- START BLOCK LOGIN -->
  <div id="id01" class="modal">
	  <form class="modal-content animate" action="index.php" method="post" style="background: #FFEC8B;">
	    <div class="imgcontainer">
	      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	      <!--<img src="img/p8.png" alt="Avatar" class="avatar"> -->
	    </div>
        <h3 class="h3">Login</h3>
	    <div class="form-group">
	   	<table>
        <tr>
            <td><label for="username" class="control-label"><b>Username&nbsp;&nbsp;</b></label></td>
            <td>  
              <div class="col-sm-15">
              <input type="text" class="form-control" id="username" placeholder="Username" 
              name="username" pattern="{8,40}" title="กรุณาใส่ชื่อผู้ใช้ใหม่อีกครั้ง" required>
              </div>
            </td>
          </tr>
          <tr>
              <td>
                <br>
              </td>
          </tr>
          <tr>
            <td><label for="inputPassword" class="control-label"><b>Password&nbsp;&nbsp;</b></label></td>
            <td>
              <div class="col-sm-15">
                <input type="password" class="form-control" placeholder="Enter Password"  
                For = "password" id="password" name="password" 
                   title="กรุณาใส่รหัสผ่านใหม่อีกครั้ง" required>
                   <!-- pattern="[A-za-z0-9]{8,16}"" -->
              </div>
            </td>
          </tr>
      <tr><td> <?php if(isset($msg)AND$msg!=''){echo $msg;} ?> </td></tr>
	    </table>  
	      <button type="submit" class="bbutton">OK</button><br>
	    </div>
	  </form>
	</div>
 <!-- END BLOCK LOGIN -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


    <a href="#" onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><img src="img/bregis.png" width="150px" height="50px"></a>

     <!-- START BLOCK REGISTER -->
    <div id="id02" class="modal1">      
      <form class="modal1-content animate form-horizontal" action="mRegis.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal1">&times;</span>
          <!--<img src="img/p8.png" alt="Avatar" class="avatar"> -->
        </div>
          <h3 class="h3">Register</h3><br>
            
            <div class="form-group" method="post" action ="mRegis.php">
            <table border='0' style="width:85%;">
             <tr>
                  <td><label for="checkbox" class="control-label" name="checkbox1"><b>Type</b></label></td>
                  <div class="col-sm-4">
                    <td>
                        <input type="radio" class="" id="checkbox1" value="1"  name="checkbox1" onclick="checksec_year()" checked required>Member &nbsp;
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

                <tr>
                  <td><label for="username" class="control-label"><b>Username</b></label></td>
                  <div class="col-sm-4">
                    <td><input type="text" class="form-control" id="Regusername" placeholder="Username" name="rusername" 
                          pattern="{8,40}" title="Please input username again" required>
                          <b><small style="color:black;" id="usernameCondition">* 8-40 characters, a-zA-Z0-9</small></b>
                    </td>
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
                    pattern="\w{8,16}" title="Please input password again" required>
                    <small style="color:black;"><b>* 8-16 characters, a-zA-Z0-9</b></small>
                    </td>
                  </div>
                </tr>
                <tr>
                  <td>
                    <br>
                  </td>
               </tr>                
                <tr>
                <td><label for="inputPassword1" class="control-label"><b>Confirm Password</b></label></td>
                  <div class="col-sm-4">
                    <td><input type="password" class="form-control" id="inputPassword3" placeholder="Password" 
                    pattern="\w{8,16}" title="Please input password again" required>

                    </td>
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
                       pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z.]+" title="Please input E-Mail again" required>
                       <small style="color:black;"><b>pattern ex. 'seniorProject14@kku.ac.th'</b></small>
                    </td>
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
                 pattern="[a-zA-Z]{1,50}" title="Please input First Name again" required>
                    <small style="color:black;"><b>English only</b></small>
                 </td>
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
                pattern="[a-zA-Z]{1,50}" title="Please input Last Name again" required>
                 <small style="color:black;"><b>English only</b></small>
                 </td>
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
                    <input type="date" id="meeting" class="form-control"  name="bdate"/>
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
                  <tr hidden="true" id ="hidesec">
                    <td ><label for="inputPassword" class="control-label"><b>Teacher & Section</b></label></td>
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
                    <br>   
                      <div id="ajax_reply_div">

                       
                     </div>

                  
<!-- dropdown T^T   <nav id="primary_nav_wrap">
                        <ul>
                          <li><a href="#" style="background-color: #FFCC33">Teacher</a>
                            <ul>
                            <li class="dir"><a href="#">T 1</a>
                            <li class="dir"><a href="#">T 2</a>
                                <ul>
                                  <li><a href="#">sec. 1</a></li>
                                  <li><a href="#">sec. 2</a></li>
                                  <li><a href="#">sec. 3</a></li>
                                </ul>
                              </li>
                            <li class="dir"><a href="#">T 3</a>
                        </ul>
                        </nav>
                    </td> -->
                    <!-- <td><label for="Section" class="control-label col-sm-2"><b>Section</b></label></td>
                    <div class="col-sm-1">
                      <td><input type="text" class="form-control" id="Section" placeholder="Section" 
                      pattern="\d{2}" title="กรุณาใส่กลุ่มเรัยนใหม่อีกครั้ง"  required></td>
                    </div>
                  </tr>
                   <tr hidden="true" id ="hideyear">
                    <td><label for="Year" class="control-label col-sm-2 "><b>Year</b></label></td>
                      <div class="col-sm-1">
                        <td><input type="text" class="form-control" id="Year" placeholder="Year" 
                        pattern="\d{4}" title="กรุณาใส่ปีการศึกษาใหม่อีกครั้ง" required></td>
                      </div> -->
                    </tr>



                <!--<tr>
                  <td><label for="studentid" class="control-label col-sm-2 "><b>Student ID</b></label></td>
                  <div class="col-sm-2">
                 <td>   <input type="text" class="form-control" id="studentid" placeholder="Student ID" required></td>
                  </div>    
                </tr> -->
<!--                <tr>
                 <td> <label for="Major" class="control-label col-sm-2 "><b>Major</b></label></td>
                  <div class="col-sm-2">
                <td>   <input type="text" class="form-control" id="Major" placeholder="Major" name="major"
                pattern="\D{1,50}" title="กรุณาใส่ชื่อสาขาใหม่อีกครั้ง" required></td>
                  </div>    
                </tr>
                <tr>
                  <td><label for="Faculty" class="control-label col-sm-2 " name="faculty"><b>Faculty</b></label></td>
                  <div class="col-sm-2">
                <td>  <input type="text" class="form-control" id="Faculty" placeholder="Faculty" 
                pattern="\D{1,50}" title="กรุณาใส่ชื่อคณะใหม่อีกครั้ง" required></td>
                  </div>
                </tr> -->
                
                </div>
          </table><br>


          <button type="submit" class="bbutton">OK</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="reset" class="bbutton">CANCEL</button>
          
        </div><br>
      </form>
    </div>
     <!-- END BLOCK REGISTER -->
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
	// Get the modal
	var modal = document.getElementById('id01');
    var modal1 = document.getElementById('id02');

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal.style.display = "none";
        }
    }
    function checksec_year(){

      if(document.getElementById("checkbox2").checked==false){
        //if student not check --> hide
        document.getElementById("hidesec").hidden=true;
       //change username condiion to general
      document.getElementById("Regusername").pattern="{8,40}";
      document.getElementById("Regusername").title="* 8-40 characters, a-zA-Z0-9"
      document.getElementById("usernameCondition").innerHTML="* 8-40 characters, a-zA-Z0-9";

      }else{
        document.getElementById("hidesec").hidden=false;
      //username are std_id
      document.getElementById("Regusername").pattern="[0-9]{9}[-][0-9]{1}";
      document.getElementById("Regusername").title="* Pattern 5630xxxxx-x"
      document.getElementById("usernameCondition").innerHTML='* Pattern 5630xxxxx-x';
      }
    }



    //this will trigger automatically when they change the first select box
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
</html>


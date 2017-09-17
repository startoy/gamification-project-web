
        
<article>
	<br>
		<p class="editClassRoom">
		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
		Manage Section <br>&nbsp;&nbsp;&nbsp;&nbsp;<small><?php echo getNAME($tUsername); ?></small></p>
		<div class="hrBottom"></div>
		
	<!--<p class="addItem">+ ADD ITEM</p>-->
		<div class="container" 
			 style="" >
		<div class="panel-group" id="accordion" >			
		<div class="panel panel-default"  
			 style="background-color:#EEDD82; border:0px;">
		<div class="panel-heading" 
			 style="background-color:#9d472e; width: 90px; margin: 10px 300px 0px 0px;">
			<h4 class="panel-title" style="background-color:#9d472e;">
				<a data-toggle="collapse" data-parent="#accordion" href="#addSection1" style="color: #e7e9d3;">+ ADD
				</a>
			</h4>
		</div>
				<!--begin add-->
				<div id="addSection1" class="panel-collapse collapse">
					<div class="panel-body"  
			 style="background-color:#9d472e; border:0px;">
						<div class="panel-heading">
							<form class="form-horizontal" action="editsection.php" method="post" >
							 <input type="hidden" name="tname" value="<?php echo $tUsername; ?>">
  <div class="form-group">
    <label for="inputSec" class="col-sm-2 control-label">Section</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputSec" placeholder="Section" name="AddSection">
    </div>
  </div>
  <div class="form-group">
    <label for="inputYear" class="col-sm-2 control-label">Year</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputYear" placeholder="Year" name="AddYear">
    </div>
  </div>
 <div class="form-group">
    <label for="inputDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDescription" placeholder="Description" name="AddDescription">
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
		</div>

<section>

	<div class="container">

		<div class="panel-group" id="accordion">	
<?php //begin loop php each item
$sql="SELECT * FROM Section s WHERE s.username='". $tUsername ."' AND Active='Y' ORDER BY `Sec_id` DESC";
$result = mysqli_query($conn,$sql);
$idCount=0;
while($row= mysqli_fetch_assoc($result)) 
{ 
	$idCount++;
	$sec=$row["Sec"];
	$year=$row["Year"];
	$desc=$row["Description"];
?>
		<!-- begin each item-->		
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#b3ae91;">
					<h4 class="panel-title">
						<div class="SecName">

						<!-- <a href="SecDetail.php?sec-id=<?php //echo $row['Sec_id'] ?>"> -->
						
						Section <?php echo $sec; ?> / <?php echo $year; ?>

						</div>
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $idCount; ?>">
						<img class="iconU" src="img/iconUpdate.png"></a>
						<a  href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='editsection.php?tname=<?php echo $tUsername ?>&deletesec_id=<?php echo $row['Sec_id'];?>';}"><img class="iconD" src="img/iconDelete1.png" ></a>
						</div>
					</h4>



				<!-- update-->	
		<div id="collapse<?php echo $idCount; ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="panel-heading">
			<!--form action="update.php" method="POST"-->
			<div class="form">
						<form class="form-horizontal" action="editsection.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
						<input type="hidden" name="tname" value="<?php echo $tUsername; ?>">
  <div class="form-group">
    <label for="inputSec" class="col-sm-2 control-label">Section</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputSec" placeholder="Section" value="<?php echo $row["Sec"];?>" name="section">
    </div>
  </div>

  <input type="hidden" value="<?php echo $row['Sec_id'] ?>" name="secid">


  <div class="form-group">
    <label for="inputYear" class="col-sm-2 control-label">Year</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputYear" placeholder="Year" value="<?php echo $row["Year"];?>" name="year">
    </div>
  </div>
 <div class="form-group">
    <label for="inputDescribe" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDescribe" placeholder="Describe" value="<?php echo $row["Description"];?>" name="description">
    </div>
 </div>
 <div class="form-group">
    <label for="inputFile" class="col-sm-2 control-label">Student</label>
    <div class="col-sm-10">
          <input name="fileCSV" type="file" id="fileCSV" accept=".csv">
		<br><small> *support .csv with UTF-8 encoding file</small>
  </div>
  </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
 </div>	
 </div>
</form>
    </div>				
   </div>
  </div>
 </div>

<?php }?>
		</div>

	</div> <!-- end container -->

		</section>
</div>  <!-- end background -->
</article> <!-- end article  -->

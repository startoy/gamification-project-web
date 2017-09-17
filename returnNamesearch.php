<?php
///////////////////////////////////////////////////////////
//  returnNamesearch.php
//  this page will be called by AJAX
//  echo back table of teachers name
//
///////////////////////////////////////////////////////////

include("connectDB.php");
if(isset($_POST['nameLike'])){
	if($_POST['nameLike']==NULL)
	{
		echo "";
	}else{
        $result2 = mysqli_query($conn,"SELECT *,LOWER(F_name),LOWER(L_name) FROM account 
        WHERE (F_name LIKE '%".$_POST['nameLike']."%' OR L_name LIKE '%".$_POST['nameLike']."%') 
        AND AccType_id='3' ");
        $numOfrow = mysqli_num_rows($result2);
        // echo "<select id='teacherName' name = 'teacherName' class='form-control'>";
        if($numOfrow!=0){
            echo "<br><table class='table table-hover' border='0'>";
            while($row = mysqli_fetch_array($result2)){
            echo "<tr style='margin-left:10%;'>";
            echo "<td align='center' style='border-top:0px;'><b>" . $row['F_name'] ."  ". $row['L_name'] . "</b></td>";
            echo "<td style='width:25%;border-top:0px;'><a href='editsection.php?tname=".$row['username']."'>
                    <span class='glyphicon glyphicon-search'></span> View</a>
                    </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<p align='center'>No Result</p>";
        }
	}
}
?>

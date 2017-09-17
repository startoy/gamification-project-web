
<?php
include("connectDB.php");
if(isset($_POST['teacher_username'])){
    $result2 = mysqli_query($conn,"SELECT * FROM section WHERE username ='".$_POST['teacher_username']."' AND Active='Y'");
    printf ('                    <tr> 
                   
                    <td>  ');
    echo "<select id='section_id' name = 'section_id' class='form-control'>";
    while($row = mysqli_fetch_array($result2)){
      echo "<option value='" . $row['Sec_id'] . "'>" . $row['Sec'] ."/". $row['Year'] ."  ". iconv_substr($row['Description'], 0, 26, 'utf-8') . "</option>";
    }
    echo "</select>";
    printf ('  </td>
                     </tr> ');
}
?>

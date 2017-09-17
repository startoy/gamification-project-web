<?php
session_start();
setlocale(LC_ALL,'Thai');

require("connectDB.php");
echo '<script>';
echo 'console.log("'.mysqli_character_set_name($conn).'")';
echo '</script>';
?>
<!DOCTYPE html>
<html lange="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CSV To MySQL</title>
    </head>
    <body>
    <div class="">
       <!-- เหลือฝั่ง uploadCSV.php ให้เช็คไฟล์ว่าเป็น .csv จริงหรือเปล่า มีคอมม่าหรือไม่ ถ้าไม่ก็แจ้งว่าผิด บลาๆ-->
        <form action="uploadCSV.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <input name="fileCSV" type="file" id="fileCSV" accept=".csv">
            <input name="btnSubmit" type="submit" id="btnSubmit" value="Submit">
            <br><small> *support .csv with UTF-8 encoding file</small>
        </form>
    </div>
    </body>
</html>


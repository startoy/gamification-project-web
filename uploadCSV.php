<?php 
    session_start();
    // setlocale(LC_ALL,'en_US.UTF-8');
    // setlocale(LC_ALL,'Thai');

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    /*function customfgetcsv(&$handle, $length, $separator = ','){
        if (($buffer = fgets($handle, $length)) !== false) {
            return explode($separator, iconv("ISO-8859-1", "UTF-8", $buffer));
        }
        return false;
    }*/

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CSV To MySQL</title>
    </head>
    <body>

            <?php
            // START FILE PART
            move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV
            require("connectDB.php");
            mysqli_set_charset($conn, "utf8");
            $objCSV = fopen($_FILES["fileCSV"]["name"], "r");
            while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
                $tempName = explode(" ",$objArr[1]); // tempName[0] = firstname , tempName[1] = lastname --> split with " " (spacebar)
                $strSQL = "INSERT INTO insertcsv ";
                $strSQL .="(sid,sfname,slname) ";
                $strSQL .="VALUES ";
                $strSQL .="('".$objArr[0]."','".$tempName[0]."','".$tempName[1]."') ";
                mysqli_query($conn, "SET NAMES utf8");
                $objQuery = mysqli_query($conn,$strSQL);
            }
            fclose($objCSV);

            echo "Upload & Import Done.";
            // END FILE PART
            //   echo '<script>';
            //   echo 'console.log("สวัวสดีครับผมมมมมมมมม")';
            //   echo '</script>';
            ?>

    </body>
</html>
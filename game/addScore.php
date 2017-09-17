<?php 
/////////////////////////////////////////////////////////////////////////
/// 
/// This php page will be call from Unity to add score(each User) to DB
/// check md5 hash.
///
/////////////////////////////////////////////////////////////////////////
session_start();
require('../connectDB.php');
if(isset($_REQUEST['gameId'])&&isset($_REQUEST['hash'])){

    $name = $_SESSION['username']; 
    $gameId = mysqli_real_escape_string($conn,$_REQUEST['gameId']); 
    $levelId = mysqli_real_escape_string($conn,$_REQUEST['levelId']); 
    $subLevelId = mysqli_real_escape_string($conn,$_REQUEST['subLevelId']);     
    $score = mysqli_real_escape_string($conn,$_REQUEST['score']); 
    $medal = mysqli_real_escape_string($conn,$_REQUEST['medal']); 
    $secretKey="senior2017";

    $hash = $_REQUEST['hash']; 
    
    //md5 hash.
    $expected_hash = md5( $gameId . $levelId . $subLevelId . $score .  $medal . $secretKey); 
    
    //If what we expect is what we have:
    if($expected_hash == $hash) {
        // query to insert/update scores
        // medal 1Gold 2Silver 3Bronze
        $query = "INSERT INTO playhistory
                    SET `Score`= $score,
                    `Upd_date`= CURRENT_TIMESTAMP,
                    `SubG_id`= '$levelId',
                    `username`= '$name',
                    `Medal_id`= '$medal',
                    `Game_id`= '$gameId',
                    `Level_id`= '$subLevelId'
                    ON DUPLICATE KEY UPDATE
                    `Upd_date` = if('$score'>Score,CURRENT_TIMESTAMP,`Upd_date`),
                    `Score` = if('$score'>Score, '$score', Score)"; 
        
        $result = mysqli_query($conn,$query) or die($name ." ". $score ." ". $gameId ." ". $levelId ." ". $subLevelId ." ". $medal ." ". 'Query failed: ' . mysqli_error($conn)); 
        // if($result){ echo 'insert complete ' .  $result .' '. $name .' score= '. $score.' gameId'.$gameId ;}
    }
} 
?>
<?php 
session_start();
require('./connectDB.php');

$accType = $_SESSION['acctype'];
$username =  $_SESSION['username'];
            //for test
            // $accType = "2";
            // $username = "573020384-7";
            // $secid = 19;

if($accType=="2"){
    //if is student roll -> query with section id
    $secid =  $_SESSION['secid'];
    $query = "SELECT
            p.username as username,
            SUM(p.Score) as score,
            concat(ac.F_name,' ',ac.L_name) as name
            FROM
            playhistory p,
            ACCOUNT ac
            WHERE
            p.username = ac.username AND ac.Sec_id = '$secid'
            GROUP BY
            p.username
            ORDER BY
            score DESC,
            name ASC";
}else{
    $query = "SELECT
            p.username as username,
            SUM(p.Score) as score,
            concat(ac.F_name,' ',ac.L_name) as name
            FROM
            playhistory p,
            ACCOUNT ac
            WHERE
            p.username = ac.username AND ac.AccType_id = '$accType'
            GROUP BY
            p.username
            ORDER BY
            score DESC,
            name ASC";
}
mysqli_set_charset($conn,"utf8");
$result = mysqli_query($conn,$query) or die('Query failed: ' . mysqli_error($conn)); 
while($r= mysqli_fetch_assoc($result)) 
{
    // echo $r['name'], "\t", $r['score'], "\n";
    echo iconv_substr($r['name'], 0, 26, 'utf-8'), "\t", $r['score'], "\n";
     
}
mysqli_close($conn);


/////////////////////////////////////////////////
// string sanitize functionality to avoid
// sql or html injection abuse and bad words
/////////////////////////////////////////////////

function my_utf8($string)
{
    return strtr($string,
      "/<>€µ¿¡¬ˆŸ‰«»Š ÀÃÕ‘¦­‹³²Œ¹÷ÿŽ¤Ððþý·’“”ÂÊÁËÈÍÎÏÌÓÔ•ÒÚÛÙž–¯˜™š¸›",
      "![]YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
}
function safe_typing($string)
{
    return preg_replace("/[^a-zA-Z0-9 \!\@\%\^\&\*\.\*\?\+\[\]\(\)\{\}\^\$\:\;\,\-\_\=]/", "", $string);
}
function sanitize($string)
{
    // make sure it isn't waaaaaaaay too long
    $MAX_LENGTH = 250; // bytes per chat or text message - fixme?
    $string = substr($string, 0, $MAX_LENGTH);
    $string = no_naughty($string);
    // breaks apos and quot: // $string = htmlentities($string,ENT_QUOTES);
    // useless since the above gets rid of quotes...
    //$string = str_replace("'","&rsquo;",$string);
    //$string = str_replace("\"","&rdquo;",$string);
    //$string = str_replace('#','&pound;',$string); // special case
    $string = my_utf8($string);
    $string = safe_typing($string);
    return trim($string);
}

?>
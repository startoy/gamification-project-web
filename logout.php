<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['acctype']);
unset($_SESSION['secid']);
session_destroy();

header("Location: index.php");
exit;
?>
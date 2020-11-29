<?php
session_start();
if($_SERVER['SERVER_NAME']==="localhost")
{
    $baseDir = $_SERVER['DOCUMENT_ROOT']."/voteonitnow";
}
else{
    $baseDir = $_SERVER['DOCUMENT_ROOT'];
}

include $baseDir."/config/config.php";
include $baseDir."/system/init.php";
?>


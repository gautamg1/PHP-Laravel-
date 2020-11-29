<?php

//Database configurations

if(isset($_SERVER['HTTPS'])){
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
}
else{
    $protocol = 'http://';
}
// For Base Directory and Base URL
$projectName = "/voteonitnow";

if($_SERVER['SERVER_NAME']==="localhost")
{
    $baseUrl = $protocol.$_SERVER['SERVER_NAME'].$projectName;
    $BASE_DIR = $_SERVER['DOCUMENT_ROOT'].$projectName;
}
else{

    $baseUrl = $protocol.$_SERVER['SERVER_NAME'];
    $BASE_DIR = $_SERVER['DOCUMENT_ROOT'];
}

// live document_root path = /home/115345.cloudwaysapps.com/epembryzrw/public_html/
// live $_SERVER['SERVER_NAME'] = phpstack-115345-1143415.cloudwaysapps.com
// local $_SERVER['SERVER_NAME'] = localhost

define('HOST', "localhost");
define('USER', "root");
define('DATABASE', "voteonitnow");
define('PASSWORD', "mysql");

define('BASE_URL',$baseUrl);
define("BASE_DIR",$BASE_DIR);



?>




















































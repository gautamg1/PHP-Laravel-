<?php

spl_autoload_register(
	function($className)
{
	include BASE_DIR."/system/classes/".$className.".php";
}
);
$route = new Route;

?>


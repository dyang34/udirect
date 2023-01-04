<?php
//@ session_start();

header("Content-Type:text/html; charset=UTF-8");
extract($_POST);
extract($_GET);
extract($_SERVER);
extract($_FILES);
extract($_ENV);
extract($_COOKIE);
extract($_SESSION);

/*
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
*/
ini_set("display_errors","0");

if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']=="") {
	$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location: $redirect");
}
?>
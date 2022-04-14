<?php 
session_start();

require 'functions.php';

if( isset($_SESSION["login"]) ) {
    if(isset($_SESSION["Admin"])) {
		$login = true;
		exit;

	  }
    elseif(isset($_SESSION["Guest"])) {
		header("Location:ustadz/profile.php");
		exit;
	  } 
}


?>

<?php 

if(isset($_POST['logout'])) {

	// Include User class
	include "../model/user.classes.php";

	// Function
	$logout = new User();
	$logout->loggedOut();

	header("location: ../view/index.php");

}
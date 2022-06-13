<?php 

if(isset($_POST["deleteUserImage"])) {

	// Grabbing data
	include "../model/user.classes.php";

	$remove = new User();
	$remove->deleteUserImage();

	header("location: ../view/account.php");

}

if(isset($_POST["update"])) {

	// Grabbing data
	$imgTest    = $_POST['hiddenImage'];
	$img        = $_FILES['imageUser']['name'];
	$fname		= $_POST['firstname'];
	$lname		= $_POST['lastname'];
	$email		= $_POST['email'];
	$city		= $_POST['city'];

	// Include User class
	include "../model/user.classes.php";

	$update = new User();
	$update->updateUser($imgTest, $img, $fname, $lname, $email, $city);

	header("location: ../view/account.php");

}

if(isset($_POST["delete"])) {

	// Include User class
	include "../model/user.classes.php";

	$delete = new User();
	$delete->deleteUser();
	$delete->loggedOut();

	header("location: ../view/login.php");
}

if(isset($_POST["addDog"])) {

	// Grabbing data
	$image  = $_FILES['imageDog']['name'];
	$name 	= $_POST["name"];
	$age 	= $_POST['age'];

	// Include Dog class
	include "../model/dog.classes.php";

	$addDog = new Dog();
	$addDog->addDog($image, $name, $age);

	header("location: ../view/account.php?error=Hond%20succesvol%20toegevoegd!");  

}

if(isset($_POST["deleteDog"])) {

	// Grabbing data
	$dogId		= $_POST["deleteDog"];

	// Include Dog class
	include "../model/dog.classes.php";

	$deleteDog = new Dog();
	$deleteDog->deleteDog($dogId);
    
    header("location: ../view/account.php?error=Hond%20succesvol%20verwijderd!");

}
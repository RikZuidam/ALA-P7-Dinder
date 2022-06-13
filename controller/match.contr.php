<?php

session_start();
include "../model/pdo.php";
include "../model/user.classes.php";

if(isset($_POST['cMatch'])) {

	// Grabbing data
	$uid = $_POST['uid'];

	// Include Other class
	include "../model/other.classes.php";

	$cancelMatch = new Other();
	$cancelMatch->randomMatch();

	$today = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO dinder.matches (`get_users.id`, `gave_users.id`, `process`, `made`) VALUES (?, ?, ?, ?);");
    if(!$stmt->execute(array($uid, $_SESSION["id"], 1, $today))){
        $stmt = null;
        header("location: ../view/index.php?error=stmtfailed");
        exit();
    }

    header("location: ../view/match.php");
}

if(isset($_POST['fMatch'])) {

	// Grabbing data
	$uid 		= $_POST['uid'];
	$place 		= $_POST['place'];
	$datetime 	= $_POST['datetime'];

	// Include Other class
	include "../model/other.classes.php";

	$cancelMatch = new Other();
	$cancelMatch->randomMatch();

	$today = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO dinder.matches (`get_users.id`, `gave_users.id`, `process`, `made`, `place`, `datetime`) VALUES (?, ?, ?, ?, ?, ?);");
    if(!$stmt->execute(array($uid, $_SESSION["id"], 0, $today, $place, $datetime))){
        $stmt = null;
        header("location: ../view/index.php?error=stmtfailed");
        exit();
    }

    header("location: ../view/match.php");
}

if(isset($_POST['submitA'])) {
    
	// Grabbing data
	$uid = $_POST['submitA'];

	// Include Other class
	include "../model/other.classes.php";

	$accept = new Other();
	$accept->requestOutput($uid, 0);

	header("location: ../view/index.php");
}

if(isset($_POST['submitC'])) {

    // Grabbing data
	$uid = $_POST['submitC'];

	// Include Other class
	include "../model/other.classes.php";

	$cancel = new Other();
	$cancel->requestOutput($uid, 1);

	header("location: ../view/index.php");
	
}

if(isset($_POST['free'])) { 
		$_SESSION['ending'] += 1;
	header("location: ../view/free.php");
}
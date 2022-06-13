<?php

if(isset($_POST['submit'])){

    // Grabbing the data
    $uname  = $_POST['inputUname'];
    $pwd    = $_POST['inputPwd'];

    // Testing data
    // include "../classes/dbh.classes.php";
    include "../model/user.classes.php";

    $login = new User();
    $login->login($uname, $pwd);
    // include "../classes/dbh.classes.php";
    $testing2 = new User();
    $testing2->loggedIn();
    // if(isset($_SESSION['all'])){
        // var_dump($user['username']);
    // echo $data[0]['username'];

    // } 
    // echo $_SESSION['test'];
    // session_unset();
    // session_destroy();

    header("location: ../view/index.php");
    

}

if(isset($_POST['register'])){
    header("location: ../view/register.php");
}
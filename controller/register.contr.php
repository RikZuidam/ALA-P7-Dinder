<?php
// Register
if(isset($_POST['submit'])){

    // Grabbing the data
    $fname      = $_POST['inputFname'];
    $lname      = $_POST['inputLname'];
    $email      = $_POST['inputEmail'];
    $city       = $_POST['inputCity'];
    $uname      = $_POST['inputUname'];
    $pwd        = $_POST['inputPwd'];
    $pwdRepeat  = $_POST['inputPwdRepeat'];

    // Test data
    include "../model/user.classes.php";

    $register = new User();
    $register->register($fname, $lname, $email, $city, $uname, $pwd, $pwdRepeat);

    // Succesvol ingelogd -> doorgestuurd naar inlogpagina
    header("location: ../view/login.php");
}
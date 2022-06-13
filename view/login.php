<?php 
session_start();
session_destroy();
include "../model/user.classes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinder | Login</title>
    <?php include '../assets/stylesheets.php';?>
</head>
<body id="plogin">
    <div class="container-fluid">
        <div id="system">
            <div id="content">
                <h1 id="text">Login</h1>
                <form action="../controller/login.contr.php" method="post">
                    <input type="text" name="inputUname" id="uname" placeholder="gebruikersnaam of e-mailadres">
                    <br>
                    <input type="password" name="inputPwd" id="pwd" placeholder="wachtwoord">
                    <br>
                    <span id="error"></span><br>
                    <span><a href="./reset.php">Wachtwoord vergeten?</a></span>
                    <span><input type="submit" name="submit" value="Login" id="login"></span>
                    <hr data-content="OF" class="hr-text">
                    <span><input type="submit" name="register" value="Registreren" id="login"></span>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var currentURL = window.location.href;
        console.log(currentURL);
        let paramaters = (new URL(currentURL)).searchParams;
        var error = paramaters.get("error");
        var uname = paramaters.get("username");
        var pwd = paramaters.get("password");
        
        $("#error").html(error);
        $("#uname").val(uname);
        $("#pwd").val(pwd);
    });
</script>
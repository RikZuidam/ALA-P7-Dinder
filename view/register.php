<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinder | Registreren</title>
    <?php include '../assets/stylesheets.php';?>
</head>
<body id="plogin">
    <div class="container-fluid">
        <div id="system">
            <div id="content">
                <h1 id="text">Registreren</h1>
                <form action="../controller/register.contr.php" method="post" id="registerForm">
                    <input type="text" name="inputFname" placeholder="Voornaam" class="registerinfo" id="fname">
                    <input type="text" name="inputLname" placeholder="Achternaam" class="registerinfo" id="lname">
                    <br>
                    <input type="text" name="inputEmail" placeholder="E-mailadres" id="email">
                    <select id="citySelect" name="inputCity">
                        <?php 
                        $str = file_get_contents("../view/nl.json");
                        $data = json_decode($str, true);

                        for($i = 0; $i < count($data); $i++) {  ?>
                            <option value="<?php echo $data[$i]['city'];?>"><?php echo $data[$i]['city'];?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="inputUname" placeholder="Gebruikersnaam" id="uname">
                    <input type="password" name="inputPwd" placeholder="Wachtwoord" id="pwd">
                    <input type="password" name="inputPwdRepeat" placeholder="Herhaal uw wachtwoord" id="pwdRepeat">
                    <span id="error"></span>
                    <span><input type="submit" name="submit" value="Aanmaken" id="login"></span>
                    <span><a href="./login.php">Al een account?</a></span>
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
        let paramaters = (new URL(currentURL)).searchParams;
        var error = paramaters.get("error");
        var fname = paramaters.get("firstname");
        var lname = paramaters.get("lastname");
        var email = paramaters.get("email");
        var city = paramaters.get("city");
        var uname = paramaters.get("username");
        var pwd = paramaters.get("password");
        var pwdRepeat = paramaters.get("pwdRepeat");
        
        $("#error").html(error);
        $("#fname").val(fname);
        $("#lname").val(lname);
        $("#email").val(email);
        $("#city").val(city);
        $("#uname").val(uname);
        $("#pwd").val(pwd);
        $("#pwdRepeat").val(pwdRepeat);
    });
</script>
<?php 
session_start();
include "../view/session.php";

include "../model/user.classes.php";
$user = new User();
include "../model/other.classes.php";
$other = new Other();
$other->getDogs($_SESSION['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <?php include "../assets/stylesheets.php";?>
    <title>Document</title>
    <style>
        .bottom-left {
            position: relative;
            bottom: 45px;
            /*left: 30px;*/
            width: 100%;
            height: 50px;
            /*background-color: black;*/
            background-image: linear-gradient(transparent -20%, black);
            color: white;
        }

        .bottom-left #span {
            text-align: left;
            color: white !important;
            float: left;
            margin-left: 20px;
        }

        .carousel-border {
            width: 150px;
            height: 170px;
            margin-top: 20px;
        }

        table tr {
            border: solid 1px black;
            margin: 20px;
        }
        table {
            float: left;
        }
        
        /*.btn {
            background: none;
            padding: 0 5px;
        }*/
    </style>
</head>
<body id="baccount">
    <div id="header"><?php include "header.php";?></div>
    <div id="nav">
        <div class="container">
            <div class="row">
                <div class="col-sm"><h3 class="subtitle"><?php echo $user->username;?></h3></div>
            </div>
            <form action="../controller/account.contr.php" method="POST" enctype="multipart/form-data">
                <?php if($user->img == NULL) { ?>
                    <div class="row">
                        <div class="col-sm">
                            <label for="userImage" style="background-color: white;">
                                <i class="fa fa-plus" style="font-size: 24px; border: 1px solid black; border-radius: 10px; padding: 25px; cursor: pointer;"></i>
                            </label>
                            <input type="hidden" value="<?php echo $user->img;?>" name="hiddenImage">
                            <input type="file" name="imageUser" id="userImage" style="display: none; visibility: hidden;" onchange="getImage();">
                            <div id="display-image-user"></div>
                        </div>
                    </div>
                <?php } else { ?>
                <div class="row">
                    <div class="row" style="width: 200px; height: 200px; margin: 10px auto;">
                        <div class="col">
                            <img style="width: 100%" src="../assets/images/account/<?php echo $user->img;?>">
                            <span id="deleteUserImage"><input type="submit" class="deleteUserDog" name="deleteUserImage" value="X"></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <br><br>
                <div class="row">
                  <div class="col account-details">
                    <span style="font-weight: bold;">Voornaam</span><br>
                    <input type="text" name="firstname" id="firstname" placeholder="Voornaam">
                </div>
                    <div class="col account-details">
                        <span style="font-weight: bold;">Achternaam</span><br>
                        <input type="text" name="lastname" id="lastname" placeholder="Achternaam">
                    </div>
                </div>
                <div class="row">
                    <div class="col account-details">
                        <span style="font-weight: bold;">E-mail</span><br>
                        <input type="text" name="email" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="row">
                    <div class="col account-details">
                        <span style="font-weight: bold;">Plaats</span><br>
                        <select id="citySelect" name="city">
                            <?php 
                            $str = file_get_contents("../view/nl.json");
                            $data = json_decode($str, true);

                            for($i = 0; $i < count($data); $i++) {  ?>
                                <option value="<?php echo $data[$i]['city'];?>"><?php echo $data[$i]['city'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9 account-details">
                        <input type="submit" name="update" id="updateUser" class="bg-success" value="Updaten">
                    </div>
                    <div class="col-sm-3 account-details"><input type="submit" name="delete" id="deleteUser" class="bg-danger" value="Account verwijderen"></div>
                </div>
            </form>
            <br class="solid">
            <div class="divider-1 wow fadeInUp"></div>
            <br>
            <form action="../controller/account.contr.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col account-details"><h3 class="subtitle">Voeg een hond toe</h3></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm">
                        <label for="dogImage" style="background-color: white;">
                            <i class="fa fa-plus" style="font-size: 24px; border: 1px solid black; border-radius: 10px; padding: 25px; cursor: pointer;"></i>
                        </label>
                        <input type="file" name="imageDog" id="dogImage" style="display: none; visibility: hidden;" onchange="getImage2();">
                        <div id="display-image-dog"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col account-details">
                        <span style="font-weight: bold;">Naam</span><br>
                        <input type="text" name="name">
                    </div>
                    <div class="col account-details">
                        <span style="font-weight: bold;">Geboortejaar</span><br>
                        <input type="date" name="age">
                    </div>
                </div>
                <div id="error" class="text-danger"></div>
                <div class="row">
                    <div class="col account-details">
                        <input type="submit" name="addDog" class="bg-success" id="addDog" value="Hond toevoegen">
                    </div>
                </div>
            </form>
            <br class="solid">
            <div class="divider-1 wow fadeInUp"></div>
            <br>

            <div class="row">
                <h3 class="subtitle">Uw honden</h3>
            </div>
            <br>
            <div class="row">
                <?php 
                    if(0 == count($other->getDog)) {
                        echo "<div class='col subtitle'>Geen honden gevonden!</div>";
                    }
                ?>
            <?php for($i = 0; $i < count($other->getDog); $i++) { ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border">
                    <img style="width: 100%; height: 100%" src="../assets/images/dog/<?php echo $other->getDog[$i]["img"];?>">
                    <div class="bottom-left">
                        <span>
                            <span><form action="../controller/account.contr.php" method="POST">
                                <button type="submit" name="deleteDog" onclick="functie(this.value)" class="btn deleteUserDog" value="<?php echo $other->getDog[$i]['id'];?>">✖</button>
                            </form></span>
                            <span id="span"><?php echo $other->getDog[$i]["name"];?><br>
                            <?php
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->getDog[$i]["age"]), date_create($today));
                                echo $diff->format('%y');
                            ?>
                            </span>
                        </span>
                    </div>
                </div>
            <?php } ?>
            </div>
            <br><br>
        </div>
    </div>
    <div id="footer"><?php include "footer.php";?></div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var firstname   = $("#firstname").val("<?php echo $user->firstname;?>");
        var lastname    = $("#lastname").val("<?php echo $user->lastname;?>");
        var email       = $("#email").val("<?php echo $user->email;?>");
        $("select#citySelect").val("<?php echo $user->city;?>");
    });
</script>

<script>
    $(document).ready(function(){
        var currentURL = window.location.href;
        console.log(currentURL);
        let paramaters = (new URL(currentURL)).searchParams;
        var error = paramaters.get("error");
        var name = paramaters.get("name");
        var age = paramaters.get("age");
        
        $("#error").html(error);
        $("#name").val(name);
        $("#age").val(age);
    });

    function functie(geklikt) {
        var dogId = geklikt;
        $('#updateDogId').val(dogId);
        // $.post("../view/account.php", {dog:dogId});

    }
</script>

<?php include "../assets/scripts.php";?>

<script>
    function getImage() {
        var imageUser = $("#userImage").val();
        var imageUser2 = imageUser.replace(/^.*\\/,"");
        console.log(imageUser);

        $('#display-image-user').html(imageUser2);
    }

    function getImage2() {
        var imageDog = $("#dogImage").val();
        var imageDog2 = imageDog.replace(/^.*\\/,"");

        $('#display-image-dog').html(imageDog2);
    }
</script>
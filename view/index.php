<?php 
session_start();
include "../model/user.classes.php";
$user = new User();
include "../model/other.classes.php";

$other = new Other();
$other->newestDogs();
$other->counts();
$other->request();
$other->lastMatches();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php include "../assets/stylesheets.php";?>
    <style>
    .carousel-border {
        width: 200px;
        height: 300px;
    }

    .bottom-left {
        position: relative;
        bottom: 50px;
        /*left: 30px;*/
        width: 100%;
        height: 50px;
        /*background-color: black;*/
        background-image: linear-gradient(transparent -20%, black);
        color: white;
    }

    .bottom-left p {
        margin-left: 20px;
        color: white !important;
    }

    </style>
    
    <title>Document</title>
</head>
<body id="dashboard">
    <div id="header"><?php include "header.php";?></div>
    <div id="nav">
        <div class="container">
            <?php if(isset($_SESSION["id"])) { ?>
            <h3 style="text-align: left;">Welkom '<?php echo $user->username;?>'</h3>
            <?php } ?>
            <h3 id="onlangs">Onlangs toegevoegde honden</h3>
            <br>
            <br>
            <div id="carousel-example" class="carousel slide wow fadeInUp" data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[0]["img"];?>" class="img-fluid mx-auto d-block" alt="img1">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[0]["name"];?><br>
                                <?php 
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[0]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";
                                ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[1]["img"];?>" class="img-fluid mx-auto d-block" alt="img2">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[1]["name"];?><br>
                                <?php $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[1]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[2]["img"];?>" class="img-fluid mx-auto d-block" alt="img3">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[2]["name"];?><br>
                                <?php 
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[2]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[3]["img"];?>" class="img-fluid mx-auto d-block" alt="img4">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[3]["name"];?><br>
                                <?php 
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[3]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";
                                ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[4]["img"];?>" class="img-fluid mx-auto d-block" alt="img5">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[4]["name"];?><br>
                                <?php 
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[4]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";
                                ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[5]["img"];?>" class="img-fluid mx-auto d-block" alt="img6">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[5]["name"];?><br>
                                <?php $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[5]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[6]["img"];?>" class="img-fluid mx-auto d-block" alt="img7">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[6]["name"];?><br>
                                <?php 
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[6]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";?></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="carousel-border">
                            <img src="../assets/images/dog/<?php echo $other->newestDog[7]["img"];?>" class="img-fluid mx-auto d-block" alt="img8">
                            <div class="bottom-left">
                                <p><?php echo $other->newestDog[7]["name"];?><br>
                                <?php 
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($other->newestDog[7]["age"]), date_create($today));
                                echo $diff->format('%y')."\nJaar";?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="container">
            <br class="solid">
            <div class="divider-1 wow fadeInUp"></div>
        </div>
        <div class="container" style="text-align: center">
            <h3>Vind hier de perfecte match voor uw hond!</h3>
            <br><br>
            <a id="matchBtn" href="../view/match.php">Match</a>
        </div>
        <br><br><br>
        <div id="lableReason" class="container-fluid" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
            <h3>Vind hier mensen en honden om mee te kunnen wandelen.</h3>
        </div>
        <br><br><br><br><br><br>
        <div class="container test">
            <h3>Match verzoeken</h3>
                <?php if(isset($_SESSION['id'])) {?>
             <div class="row wow fadeInUp">
                <?php if(0 == count($other->request)) { ?>
                    <br>
                    <span class="subtitle">Geen verzoeken gevonden</span>
                <?php } else { ?>
                <?php for ($i=0; $i < count($other->request); $i++) { ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border" style="height: 200px;">
                        <img style="width: 100%; height: 100%" src="../assets/images/account/<?php echo $other->request[$i]["img"];?>">
                        <div class="bottom-left">
                            <span>
                                <span>
                                    <button onclick="placetime(this.value)" value="<?php echo $other->request[$i]["place"]."\n".$other->request[$i]["datetime"];?>" id="requestinfo" class="bg-transparent" style="border: none; cursor: pointer; color: white !important;">ⓘ</button>
                                    <form action="../controller/match.contr.php" method="POST" style="position: absolute; top: 0; right: 0;">
                                        <button value="<?php echo $other->request[$i]["gave_users.id"];?>" id="cancelRequest" class="matchRequest" name="submitC">✖</button>
                                        <button value="<?php echo $other->request[$i]["gave_users.id"];?>" id="acceptRequest" class="matchRequest" name="submitA">✔</button>
                                    </form>
                                </span>
                                <br>
                                <span id="requestUsername"><?php echo $other->request[$i]["username"];?></span>
                            </span>
                        </div>
                    </div>
                <?php }} ?>
            </div>
            <?php } else { ?>
            <h1 class="not-logged-in-text">Log in om je Match verzoeken te zien!</h1>
            <div class="row wow fadeInUp">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage1.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage0.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage1.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage2.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage2.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage1.jpg"></div>
            </div>
            <?php } ?>
        </div>
        <div class="container">
            <br class="solid">
            <div class="divider-1 wow fadeInUp"></div>
        </div>
        <div class="container">
            <h3>Vind hier je laatste matches</h3>
                <?php if(isset($_SESSION['id'])) {?>
            <div class="row wow fadeInUp" id="matchesL">
                <?php if(0 == count($other->lastMatches)) { ?>
                    <br>
                    <span class="subtitle">Geen verzoeken gevonden</span>
                <?php } else { ?>
                <?php for ($i=0; $i < count($other->lastMatches); $i++) { ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border" style="height: 200px;">
                        <img style="width: 100%; height: 100%" src="../assets/images/account/<?php echo $other->lastMatches[$i]["img"];?>">
                        <div class="bottom-left">
                            <span id="requestUsername"><?php echo $other->lastMatches[$i]["username"];?></span>
                        </div>
                    </div>
                <?php }} ?>
            </div>
            <?php } else { ?>
            <h1 class="not-logged-in-text">Log in om je laatste Matches te zien!</h1>
            <div class="row wow fadeInUp">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage0.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage2.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage0.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage2.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage1.jpg"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-1 carousel-border not-logged-in" style="height: 200px;"><img src="../assets/images/test/testimage0.jpg"></div>
            </div>
            <?php } ?>
        </div>
        <br><br>
        <div id="lableCounter" class="container-fluid">
            <div class="row lableCounter-row">
                <div class="col-sm">
                    <p class="users">Dinder heeft al <span class="users-number wow fadeInUp text-danger"><?php echo $other->count["users"];?></span> gebruikers!</p>
                </div>
                <div class="col-sm">
                    <p class="users">Dinder heeft al <span class="users-number wow fadeInUp text-danger"><?php echo $other->count["matches"];?></span> matches gemaakt!</p>
                </div>
            </div>
        </div>
        <div class="container wow fadeInUp">
            <div id="contact">
                <h3>Contact</h3>
                <p>Heeft u vragen? Klik <a href="#">hier</a> om naar het contactformulier te gaan.</p>
            </div>
            
        </div>
    </div>

    <div id="footer"><?php include "footer.php";?></div>

    
</body>
</html>

<?php include "../assets/scripts.php";?>

<script>
    $(document).ready(function(){
        var currentURL = window.location.href;
        console.log(currentURL);
        let paramaters = (new URL(currentURL)).searchParams;
        var error = paramaters.get("error")
        
        console.log(error);
        if(error != null) {
            alert(error);
        }
    });

    $('#requestinfo').click(function(){
        var echo = $('#requestinfo').val();
        alert(echo);
    });
</script>
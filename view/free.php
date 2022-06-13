<?php 
session_start();
include "../model/testdata.classes.php";
$freeuser = new Test();
$freeuser->getFreeProfile();
if(!isset($_SESSION['ending'])) {
	$_SESSION['ending'] = 0;
}
if($_SESSION['ending'] >= 3) {
	header("location: ../view/index.php?error=Creëer%20een%20account%20om%20door%20te%20gaan!");
}
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
</head>
<body id="free">
	<div id="header"><?php include "../view/header.php";?></div>
	<div id="nav">
		<div class="container">
			<div class="row">
				<div class="card col-xl-6 col-lg-6 col-md-7 col-sm-8 col-xs-8">
					<img class="card-img-top" src="../assets/images/test/testimage<?php echo $_SESSION['ending'];?>.jpg" alt="Card image cap">
				  	<form action="../controller/match.contr.php" method="POST">
					  	<div class="card-body">
						    <h5 class="card-title"><?php echo $freeuser->freeaccount["fname"];?></h5>
						    <p class="card-text">
						    	<span class="left">Naam: <?php echo $freeuser->freeaccount["fname"]." ".$freeuser->freeaccount["lname"];?></span>
						    	<span class="right">Aantal honden: <?php echo $freeuser->freeaccount["dog"];?></span><br>
						    	<span class="left"> In de buurt van: <?php echo $freeuser->freeaccount["city"];?></span>
						    </p><br>
						    <input type="submit" value="X" name="free" class="btn btn-danger left">
						    <input type="submit" value="Flag" name="free" class="btn btn-success right">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php echo $freeuser->name;?>
</body>
</html>

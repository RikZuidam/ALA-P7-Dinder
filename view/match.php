<?php 
session_start();
	include "../model/user.classes.php";
	include "../model/other.classes.php";
	$user = new User();
	$other = new Other();
	include "../view/session.php";
	$other->randomMatch();
	$other->getDogs($other->randomMatch[0]["id"]);
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
    	.card {
    		margin: 0 auto;
    	}
    	.card-title {
    		text-align: center;
    	}

    	.left { margin-left: 0; float: left; }
    	.right { margin-right: 0; float: right; }

    	.card .btn { 
    		color: white !important; 
    		text-align: center;
    		padding: 20px 0;
    		width: 100px;
    	}
    	span, input {
    		margin: 10px;
    	}
    	input {
    		width: 100%;
    	}
    	#coltijdelijk {
    		width: 150px;
    		height: 150px;
    	}
    	#coltijdelijk img {
    		width: 100%;
    	}
    </style>
</head>
<body>
	<div id="header"><?php include "../view/header.php";?></div>
	<div id="nav">
		<div class="container">
			<div class="row">
				<div class="card col-xl-4 col-lg-6 col-md-7 col-sm-8 col-8">
					<?php if ($other->randomMatch[0]['img'] != NULL) { ?>
						<img class="card-img-top" src="../assets/images/account/<?php echo $other->randomMatch[0]['img']; ?>" alt="Card image cap">
					 <?php } else { ?>
						<img class="card-img-top" src="../assets/images/test/no-user-image.png" alt="Card image cap">
					 <?php } ?>
				  	<form action="../controller/match.contr.php" method="POST">
				  		<input type="hidden" name="uid" value="<?php echo $other->randomMatch[0]['id'];?>">
					  	<div class="card-body">
						    <h5 class="card-title"><?php echo $other->randomMatch[0]['username'];?></h5>
						    <span class="card-text">
						    		<span class="left">Naam: <?php echo $other->randomMatch[0]['firstname'];?> <?php echo $other->randomMatch[0]['lastname'];?></span>
						    		<span class="right">Aantal honden: <?php echo $other->randomCount;?></span>
						    	<br><br><br>
						    	Waar: <br><input type="text" name="place" placeholder="Waar:" required><br>
						    	Wanneer: <br><input type="datetime-local" name="datetime" placeholder="Wanneer" required>
						    </span>
						    <br>
						    <input type="submit" value="X" name="cMatch" class="btn btn-danger left">
						    <input type="submit" value="Flag" name="fMatch" class="btn btn-success right">
						</div>
					</form>
					<div class="row">
				    	<?php for($i = 0; $i < count($other->getDog); $i++) { ?>
				    		<div id="coltijdelijk" class="col-xl-4 col-lg-6 col-md-7 col-sm-8 col-8"><img src="../assets/images/dog/<?php echo $other->getDog[$i]["img"];?>"></div>
				    		<button onclick="doginfo(this.value)" value="<?php echo "Naam: ".$other->getDog[$i]["name"]."\n"."Geboren: ".$other->getDog[$i]["age"];?>" id="doginfo" class="bg-transparent" style="border: none; cursor: pointer; color: black !important;">ⓘ</button>
				    	<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
	</div>
	<div id="footer"><?php include "../view/footer.php";?></div>
</body>
</html>

<?php include "../assets/scripts.php";?>

<script>
	$('#doginfo').click(function() {
		var doginfo = $('#doginfo').val();
		alert(doginfo);
	});	
</script>

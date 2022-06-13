<?php 
if(isset($_SESSION["id"])) { 
    $other->matchRequestStatus();
} else {}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid" id="stickytop">
    <a class="navbar-brand" href="../view/"><img id="logo" src="../assets/images/header/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['id'])) {?>
                <a class="nav-link" id="match" href="../view/match.php">Match</a>
            <?php } else {}?>
        </ul>
        <?php if(!isset($_SESSION["id"])) { ?>
        <ul class="navbar-nav not-logged-in-link">
            <a class="nav-link" id="match" href="../view/free.php">Gratis proberen</a>
        </ul>
        <?php } else { ?>
            <ul class="navbar-nav mr-auto"></ul>
        <?php } ?>
        <?php if(isset($_SESSION["id"])) { ?>
        <ul class="navbar-nav mr-right"><button class="bg-transparent" style="border: none;" data-toggle="modal" data-target="#exampleModal"><img src="../assets/images/header/mail-logo.jpg"></button></ul>
        <?php } else {}?>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <?php if(!isset($_SESSION['id'])) {
                    ?>
                    <a class="nav-link" href="../view/login.php" id="navbarDropdownMenuLink">Login</a>
                    <?php
                } else { ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $user->username;?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../view/account.php">Profiel</a>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="./login.php">Uitloggen</a> -->
                    <form action="../controller/logout.contr.php" method="POST"><input class="dropdown-item" type="submit" id="logout" value="Uitloggen" name="logout"></form>
                </div>
                <?php }?>
            </li>
        </ul>
    </div>
</nav>

<?php if(isset($_SESSION["id"])) { ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verzoekstatus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
            if(count($other->matchStatus) < 1) { ?>
                <span>Geen verzoeken!</span>
            <?php } else { 
                for($i = 0; $i < count($other->matchStatus); $i++) {
                    if($other->matchStatus[$i]["status"] == NULL){ ?>
                        <span class="text-dark"><?php echo $other->matchStatus[$i]["username"]?> : heeft nog niet gereageerd!</span><br>
                 <?php } elseif($other->matchStatus[$i]["status"] == 1){ ?>
                        <span class="text-danger"><?php echo $other->matchStatus[$i]["username"]?> : heeft de match geannuleerd!</span><br>
                <?php } else { ?>
                        <span class="text-success"><?php echo $other->matchStatus[$i]["username"]?> : heeft de match geaccepteerd!</span><br>
            <?php }}} ?>
      </div>
    </div>
  </div>
</div>
<?php } else {}?>
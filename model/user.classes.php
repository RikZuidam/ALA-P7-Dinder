<?php

class User{

    private $connection;
    private $id;
    public $username;
    public $email;
    private $password;
    private $passwordrpt;
    public $firstname;
    public $lastname;
    public $city;
    public $img;

    public function __construct() {
        include "../model/pdo.php";
        $this->connection = $conn;

        session_start();

        if($this->loggedIn()){
            $this->getUser();
        }
    }

    public function login($uname, $pwd){
        $this->username = $uname;
        $this->password = $pwd;
        if (empty($this->username) || empty($this->password)){
            header("location: ../view/login.php?error=Vul%20hier%20je%20inloggegevens%20in!");
            exit();
        } 
        $stmt = $this->connection->prepare("SELECT * FROM dinder.users WHERE username = ? OR email = ?;");
        
        if(!$stmt->execute(array($this->username, $this->username))){
            $stmt = null;
            header("location: ../view/login.php?error=smtfailed");
            exit();
        }

        if($stmt->rowCount() < 1){
            $stmt = null;
            header("location: ../view/login.php?error=Ongeldig%20gebruikersnaam%20/%20wachtwoord!&username=".$this->username."&password=".$this->password."");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $password = $data[0]["password"];
        
        $verify = password_verify($this->password, $password);
        
        if($verify == false){
            header("location: ../view/login.php?error=Ongeldig%20gebruikersnaam%20/%20wachtwoord!");
            exit();
        }

        $_SESSION['id']      = $data[0]['id'];
    }

    public function register($fname, $lname, $email, $city, $uname, $pwd, $pwdRepeat){
        $this->firstname      = $fname;
        $this->lastname       = $lname;
        $this->email          = $email;
        $this->city           = $city;
        $this->username       = $uname;
        $this->password       = $pwd;
        $this->passwordrpt    = $pwdRepeat;

        $urldata = "&firstname=".$this->firstname."&lastname=".$this->lastname."&email=".$this->email."&city=".$this->city."&username=".$this->username."";

        if (empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->username) || empty($this->password)|| empty($this->passwordrpt)){
            header("location: ../view/register.php?error=Vul%20alle%20velden%20in!".$urldata);
            exit();
        } 

        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
            header("location: ../view/register.php?error=Vul%20geldige%20data%20in!".$urldata);
            exit();
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../view/register.php?error=Vul%20een%20geldig%20e-mailadres%20in!".$urldata);
            exit();
        }

        if ($this->password != $this->passwordrpt){
            header("location: ../view/register.php?error=Wachtwoord%20niet%20hetzelfde!".$urldata);
            exit();
        }
        $stmt = $this->connection->prepare("SELECT * FROM dinder.users WHERE username = ? OR email = ?;");
        if(!$stmt->execute(array($this->username, $this->email))){
            $stmt = null;
            header("location: ../view/register.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() > 1){
            $stmt = null;
            header("location: ../view/register.php?error=Username%20of%20email%20bestaat%20al!".$urldata);
            exit();
        }


        $hashedPwd = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $this->connection->prepare("INSERT INTO dinder.users (username, email, password, firstname, lastname, city) VALUES (?, ?, ?, ?, ?, ?);");
        if(!$stmt->execute(array($this->username, $this->email, $hashedPwd, $this->firstname, $this->lastname, $this->city))){
            $stmt = null;
            header("location: ../view/register.php?error=stmtfailed");
            exit();
        }
    }

    private function getUser(){
        $stmt = $this->connection->prepare("SELECT * FROM dinder.users WHERE id = ?;");
        if(!$stmt->execute(array($_SESSION["id"]))){
            $stmt = null;
            header("location: ../view/login.php?error=luktniet");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->id = $data[0]["id"];
        $this->username = $data[0]["username"];
        $this->email = $data[0]["email"];
        $this->firstname = $data[0]["firstname"];
        $this->lastname = $data[0]["lastname"];
        $this->city = $data[0]["city"];
        $this->img = $data[0]["img"];
    }

    public function updateUser($imgTest, $img, $fname, $lname, $email, $city) {
        $imgTest = $imgTest;
        $this->img = $img;
        $this->firstname = $fname;
        $this->lastname = $lname;
        $this->email = $email;
        $this->city = $city;

        $uploadDirectory = "../assets/images/account/";

        $fileExtensionsAllowed = ['jpeg', 'JPEG','jpg', 'JPG','png', 'PNG']; // These will be the only file extensions allowed 

        $fileName = $_FILES['imageUser']['name'];
        $fileSize = $_FILES['imageUser']['size'];
        $fileTmpName  = $_FILES['imageUser']['tmp_name'];
        $fileType = $_FILES['imageUser']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));
        $sfileName = $_SESSION['id']."z".$fileName;

        $uploadPath = $uploadDirectory . basename($sfileName); 

        if($fileName != $imgTest) {

            if (! in_array($fileExtension,$fileExtensionsAllowed)) {
                header("location: ../view/account.php?error=Fout%20extensie!");
                exit();
            }

            if ($fileSize > 4000000) {
                header("location: ../view/account.php?error=Groter%20dan%204MB!");
                exit();
            }

            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if (!$didUpload) {
                header("location: ../view/account.php?error=contact%20the%20administrator!");
                exit();
            }

            $stmt = $this->connection->prepare("UPDATE dinder.users SET `img` = ? WHERE id = ?;");
            if(!$stmt->execute(array($sfileName, $_SESSION['id']))){
                $stmt = null;
                header("location: ../view/account.php?error=smtfailed");
                exit();
            }
        }

        $stmt = $this->connection->prepare("UPDATE dinder.users SET `email` = ?, `firstname` = ?, `lastname` = ?, `city` = ? WHERE id = ?;");
        if(!$stmt->execute(array($this->email, $this->firstname, $this->lastname, $this->city, $_SESSION['id']))){
            $stmt = null;
            header("location: ../view/account.php?error=smtfailed");
            exit();
        }
    }

    public function deleteUserImage() {
        // $this->img;
        $filepath = "../assets/images/account/".$this->img;

        // Delete image in directory
        unlink($filepath);

        $stmt = $this->connection->prepare("UPDATE dinder.users SET `img` = ? WHERE id = ?;");
        if(!$stmt->execute(array(NULL, $_SESSION['id']))){
            $stmt = null;
            header("location: ../view/account.php?error=smtfailed");
            exit();
        }
    }

    public function deleteUser() {
        $filepath = "../assets/images/account/".$this->img;

        // Delete User image in directory
        unlink($filepath);

        $stmt = $this->connection->prepare("DELETE FROM dinder.users WHERE id = ?;");
        if(!$stmt->execute(array($_SESSION['id']))){
            $stmt = null;
            header("location: ../view/account.php?error=smtfailed");
            exit();
        }

        // Delete Dogs image in directory
        $filepath = "../assets/images/dog/".$_SESSION['id']."@*";
        $files = glob($filepath);

        foreach ($files as $file) {
            unlink($file);
        }

        // Delete dog in DB
        $stmt = $this->connection->prepare("DELETE FROM dinder.dogs WHERE `users.id` = ?;");
        if(!$stmt->execute(array($_SESSION['id']))){
            $stmt = null;
            header("location: ../view/account.php?error=stmtfailed2");
            exit();
        }

    }

    public function loggedIn() {
        if(isset($_SESSION['id'])){
            return true;
            exit();
        } else {
            return false;
            exit();
        }
    }

    public function loggedOut() {
        session_start();
        session_unset();
        session_destroy();
    }
}
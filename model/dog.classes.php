<?php

class Dog{
    
    private $connection;
    private $id;
    public $name;
    public $age;
    public $userid;
    public $img;

    public function __construct() {
        include "../model/pdo.php";
        $this->connection = $conn;

        session_start();
    }

    public function addDog($image, $name, $age) {
        $this->img   = $image;
        $this->name  = $name;
        $this->age   = $age;

        if(empty($this->img)) {
            header("location: ../view/account.php?error=Voeg%20een%20foto%20toe!");
            exit();
        }
        if(empty($this->name) || empty($this->age)) {
            header("location: ../view/account.php?error=empty");
            exit();
        }

        $stmt = $this->connection->prepare("SELECT name FROM dinder.dogs WHERE name = ? && `users.id` = ?;");
        if(!$stmt->execute(array($this->name, $_SESSION['id']))){
            $stmt = null;
            header("location: ../view/account.php?error=luktniet");
            exit();
        }

        if($stmt->rowCount() > 0){
            $stmt = null;
            header("location: ../view/account.php?error=U%20heeft%20al%20een%20hond%20de%20naam%20".$this->name."!");
            exit();
        }

        $uploadDirectory = "../assets/images/dog/";

        $fileExtensionsAllowed = ['jpeg', 'JPEG', 'jpg', 'JPG','png', 'PNG']; // These will be the only file extensions allowed 

        $fileName = $_FILES['imageDog']['name'];
        $fileSize = $_FILES['imageDog']['size'];
        $fileTmpName  = $_FILES['imageDog']['tmp_name'];
        $fileType = $_FILES['imageDog']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));
        $sfileName = $_SESSION['id']."@".$fileName;

        $uploadPath = $uploadDirectory . basename($sfileName); 

        if(strstr($fileName, '@')){
            header("location: ../view/account.php?error=Zorg%20ervoor%20dat%20de%20Foto%20URL%20geen%20speciale%20tekens%20bevat!");
            exit();
        }

        $exist = glob($uploadPath);

        if(count($exist) > 0) {
            header("location: ../view/account.php?error=Benoem%20je%20Foto%20URL%20anders!%20Je%20hebt%20deze%20foto%20al%20gekozen!");
            exit();
        }  

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

        $stmt = $this->connection->prepare("INSERT INTO dinder.dogs (`name`, `age`, `users.id`, `img`) VALUES (?, ?, ?, ?)");
        if(!$stmt->execute(array($this->name, $this->age, $_SESSION['id'], $sfileName))){
            $stmt = null;
            header("location: ../view/account.php?error=stmtfailed");
            exit();
        }
    }

    public function deleteDog($dogId){
        $this->id = $dogId;

        $stmt = $this->connection->prepare("SELECT img FROM dinder.dogs WHERE id = ?;");
        if(!$stmt->execute(array($this->id))){
            $stmt = null;
            header("location: ../view/account.php?error=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $filepath = "../assets/images/dog/".$data[0]['img'];

        // Delete image in directory
        unlink($filepath);

        // Delete dog in DB
        $stmt = $this->connection->prepare("DELETE FROM dinder.dogs WHERE id = ? && `users.id` = ?;");
        if(!$stmt->execute(array($this->id, $_SESSION['id']))){
            $stmt = null;
            header("location: ../view/account.php?error=stmtfailed");
            exit();
        }
    }

}
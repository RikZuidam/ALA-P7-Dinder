<?php

class Other extends User{

	public $count;
	public $newestDog;
    public $getDogs;
	public $getDog;
    public $randomMatch;
    public $randomCount;
    public $request;
    public $requestOutput;
    public $lastMatches;
    public $matchStatus;

	public function __construct() {
		include "../model/pdo.php";
		$this->connection = $conn;

        if(isset($_SESSION["id"])) {
            $stmt = $this->connection->prepare("SELECT id, `made` FROM dinder.matches WHERE `get_users.id` = ?;");
            if(!$stmt->execute(array($_SESSION['id']))){
                $stmt = null;
                header("location: ../view/index.php?error=stmtfailed");
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($data); $i++) {
                $diff = date_diff(date_create($data[$i]["made"]), date_create($today));
                $testdif = $diff->format('%d');
                if($testdif >= 5) {
                    $stmt = $this->connection->prepare("DELETE FROM dinder.matches WHERE id = ?;");
                    if(!$stmt->execute(array($data[$i]["id"]))){
                        $stmt = null;
                        header("location: ../view/index.php?error=stmtfailed");
                        exit();
                    }
                }
            }

            
        }
        parent::__construct();
	}

	public function counts() {
        $stmt = $this->connection->prepare("SELECT count(id) FROM dinder.users;");
        if(!$stmt->execute()){
            $stmt = null;
            header("location: ../view/index.php?error=stmtfailed");
            exit();
        }
        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->count["users"] = $count[0]["count(id)"];

        $stmt = $this->connection->prepare("SELECT count(id) FROM dinder.matches WHERE status = ?;");
        if(!$stmt->execute(array(0))){
            $stmt = null;
            header("location: ../view/index.php?error=stmtfailed");
            exit();
        }
        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->count["matches"] = $count[0]["count(id)"];
	}

	public function newestDogs() {
        $stmt = $this->connection->prepare("SELECT * FROM dinder.dogs ORDER BY id DESC LIMIT 8;");
        if(!$stmt->execute()){
            $stmt = null;
            header("location: ../view/index.php?error=smtfailed");
            exit();
        };
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->newestDog = $data;
    }

    public function getDogs($id) {
        $this->getDog["uid"] = $id;
        $stmt = $this->connection->prepare("SELECT dogs.`id`, dogs.`img`, dogs.`name`, dogs.`age` FROM dinder.dogs WHERE `users.id` = ?;");
        if(!$stmt->execute(array($this->getDog["uid"]))){
            $stmt = null;
            header("location: ../view/account.php?error=luktniet");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->getDog = $data;
    }

    public function getDog($id) {
        $this->getDogs['id'] = $id;
        $stmt = $this->connection->prepare("SELECT dogs.`name`, dogs.`age`, dogs.`img` FROM dinder.dogs WHERE id = ?;");
        if(!$stmt->execute(array($this->getDogs))){
            $stmt = null;
            header("location: ../view/account.php?error=luktniet");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->getDog = $data;
    }

    public function randomMatch() {
        $stmt = $this->connection->prepare("SELECT users.`id` FROM dinder.users WHERE users.`city` = ? AND NOT users.`id` = ? AND users.`id` NOT IN (SELECT matches.`get_users.id` FROM dinder.matches WHERE matches.`gave_users.id` = ?) ORDER BY RAND() LIMIT 1;");
        if(!$stmt->execute(array($this->city, $_SESSION['id'], $_SESSION['id']))){
            $stmt = null;
            header("location: ../view/index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() < 1){
            $stmt = null;
            header("location: ../view/index.php?error=U%20heeft%20iedereen%20al%20gehad,%20probeer%20het%20later%20nog%20een%20keer!");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->connection->prepare("SELECT * FROM dinder.users JOIN dinder.dogs ON users.`id` = dogs.`users.id` WHERE users.`id` = ?;");
        if(!$stmt->execute(array($data[0]["id"]))){
            $stmt = null;
            header("location: ../view/index.php?error=stmtfailed");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->randomCount = count($data);
        $this->randomMatch = $data;        
    }

    public function request() {      
        if(isset($_SESSION['id'])) {  
            $stmt = $this->connection->prepare("SELECT `gave_users.id`, `username`, `img`, `status`, `place`, `datetime` FROM dinder.users JOIN dinder.matches ON users.`id` = matches.`gave_users.id` WHERE `get_users.id` = ? && `status` is ? ORDER BY users.`id` DESC LIMIT 6;");
            if(!$stmt->execute(array($_SESSION['id'], NULL))){
                $stmt = null;
                header("location: ../view/index.php?error=luktniet");
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $data;
        }
    }

    public function requestOutput($requestUID, $requestStatus) {
        $this->requestOutput['uid'] = $requestUID;
        $this->requestOutput['status'] = $requestStatus;
        $stmt = $this->connection->prepare("UPDATE dinder.matches SET `status` = ? WHERE `get_users.id` = ? && `gave_users.id` = ? ORDER BY id DESC LIMIT 1;");
        if(!$stmt->execute(array($this->requestOutput['status'], $_SESSION['id'], $this->requestOutput['uid']))){
            $stmt = null;
            header("location: ../view/index.php?error=luktniet");
            exit();
        }

        // $stmt = $this->connection->prepare("DELETE FROM dinder.matches WHERE `status` = ?;");
        // if(!$stmt->execute(array(1))){
        //     $stmt = null;
        //     header("location: ../view/index.php?error=stmtfailed");
        //     exit();
        // }
    }

    public function lastMatches() {
        if(isset($_SESSION['id'])) {
            $stmt = $this->connection->prepare("SELECT `gave_users.id`, `get_users.id`, `username`, `img`, `status` FROM dinder.users JOIN dinder.matches ON users.`id` = matches.`gave_users.id` WHERE `get_users.id` = ? && `status` = ? ORDER BY users.`id` DESC LIMIT 6;");
            if(!$stmt->execute(array($_SESSION['id'], 0))){
                $stmt = null;
                header("location: ../view/index.php?error=luktniet");
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->lastMatches = $data;
        }
    }

    public function matchRequestStatus() {
        $stmt = $this->connection->prepare("SELECT username, status FROM dinder.matches JOIN dinder.users ON matches.`get_users.id` = users.`id` WHERE `gave_users.id` = ? AND `process` = ?;");
        if(!$stmt->execute(array($_SESSION['id'], 0))){
            $stmt = null;
            header("location: ../view/index.php?error=luktniet");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->matchStatus = $data;
    }
}
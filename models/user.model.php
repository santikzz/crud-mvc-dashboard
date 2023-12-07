<?php

require_once "../database/database.php";

class UserModel{

    private $db;

    public function __construct(){
        $this->db = db_connect();  
    }

    public function getUser($username){
        $stmt = $this->db->prepare("SELECT id, username, hash FROM admin WHERE username = :username");
        $stmt->execute(["username" => $username]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addUser($username, $password){
        // sanitize input
        // $username = filter_var($username, FILTER_SANITIZE_STRING);
        // $password = filter_var($password, FILTER_SANITIZE_STRING);
        // hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // insert row
        $stmt = $this->db->prepare("INSERT INTO admin (username, hash) VALUES (:username, :password)");
        $stmt->execute(["username" => $username, "password" => $hashed_password]);
        return ($stmt->rowCount() > 0);
    }


}


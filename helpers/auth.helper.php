<?php

require_once "./models/user.model.php";

class AuthHelper{

    private $model;

    public function __construct(){
        $this->model = new UserModel();
    }

    private function init(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function verify(){
        
        AuthHelper::init();

        $username = $_POST["username"];
        $password = $_POST["password"];

        // sanitize input
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        // get user data
        $userdata = $this->model->getUser($username);

        // validate username and password
        if($userdata && password_verify($password, $userdata->hash)){

            $_SESSION["user_id"] = $userdata->id;
            $_SESSION["user_name"] = $userdata->username;
            $_SESSION["is_logged"] = true;

            header("Location: " . BASE_URL . "home");

        }else{
            // $this->view->showLogin("Invalid username or password");
            header("Location: " . BASE_URL . "login?invalid");
        }

    }

    public function logout(){
        AuthHelper::init();
        session_destroy();
        header("Location: " . BASE_URL);
    }

    public function isLoggedIn(){
        AuthHelper::init();
        if (isset($_SESSION['is_logged'])){
            return true;
        }
        return false;
    }

    public function getUsername(){
        if($this->isLoggedIn()){
            return strtoupper($_SESSION["user_name"]);
        }else{
            return null;
        }
    }

    public function getUserId(){
        if($this->isLoggedIn()){
            return strtoupper($_SESSION["user_id"]);
        }else{
            return null;
        }
    }

}
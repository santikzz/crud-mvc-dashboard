<?php

require_once "./models/dashboard.model.php";
require_once "./models/task.model.php";
require_once "./views/dashboard.view.php";
require_once "./models/license.model.php";

require_once './helpers/auth.helper.php';

class DashboardController{

    // private $dashboardModel;
    protected $view;
    protected $auth;


    public function __construct(){
        $this->view = new DashboardView();
        $this->auth = new AuthHelper();
        // $this->model = new DashboardModel();
        // $this->task = new TaskModel();
        // $this->license = new LicenseModel();
    }

    protected function isLoggedIn(){
        if (!$this->auth->isLoggedIn()){
            header("Location: ".BASE_URL. "login");
        }
    }

    public function showDefault(){
        // if not logged in, redirect to login
        $this->isLoggedIn(); 
        $this->view->showDefault();
    }

    public function showLogin(){
        // if already logged in, redirect to home page
        if ($this->auth->isLoggedIn()){
            header("Location: ".BASE_URL. "home");
        }
        $this->view->showLogin();
    }


}
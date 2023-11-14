<?php

require_once("./libs/smarty-4.3.4/libs/Smarty.class.php");

class DashboardView {

    protected $smarty;
    protected $auth;

    public function __construct(){
        
        $this->smarty = new Smarty(); 
        $this->auth = new AuthHelper();
        $this->smarty->assign("basehref", BASE_URL);

        $this->smarty->assign("title", 'Admin Dashboard');
        $endpoint = explode('/', $_SERVER['REQUEST_URI']);
        $this->smarty->assign("endpoint", $endpoint[sizeof($endpoint)-1]);
        $this->smarty->assign("username", $this->auth->getUsername());
        $this->smarty->assign("current_time", time());

    }

    public function showDefault(){
        $this->smarty->display("templates/dashboard_default.tpl");
    }

    public function showLogin(){
        $this->smarty->display("templates/dashboard_login.tpl");
    }

    public function showTasks($tasks, $finished, $sites, $users){
        $this->smarty->assign("tasks", $tasks);
        $this->smarty->assign("finishedTasks", $finished);
        $this->smarty->assign("sites", $sites);
        $this->smarty->assign("users", $users);
        $this->smarty->display("templates/dashboard_tasks.tpl");
    }

    public function showStatistics($statistics){
        $this->smarty->assign("statistics", $statistics);
        $this->smarty->display("templates/dashboard_statistics.tpl");
    }

    public function showLicenses($licenses, $products){
        $this->smarty->assign("licenses", $licenses);
        $this->smarty->assign("products", $products);
        $this->smarty->display("templates/dashboard_licenses.tpl");
    }

    public function showFileManager(){
        $this->smarty->display("templates/dashboard_filemanager.tpl");
    }

}
<?php

// require_once './config.php';
require_once "./controllers/dashboard.controller.php";


class TaskController extends DashboardController{

    // private $view;
    // private $auth;
    // private $licenseModel;
    private $task;

    public function __construct(){
        parent::__construct();
        $this->task = new TaskModel();
    }

    public function showTasks(){
        $this->isLoggedIn(); 

        $user_id = $this->auth->getUserId();
        
        $tasks = $this->task->getTasks($user_id);
        $finished = $this->task->getFinishedTasks($user_id);
        $sites = $this->task->getSites();
        $users = $this->task->getUsers();
        $this->view->showTasks($tasks, $finished, $sites, $users);
    }

    public function createTask(){
        $this->isLoggedIn(); 

        if(isset($_POST["task_site_id"], $_POST["task_user_id"], $_POST["task_title"], $_POST["task_details"], $_POST["task_priority"])){
            $title = $_POST["task_title"];
            $details = $_POST["task_details"];
            $site_id = $_POST["task_site_id"];
            $owner_id = $this->auth->getUserId();
            $user_id = $_POST["task_user_id"];
            $priority = $_POST["task_priority"];

            $this->task->createTask($title, $details, $site_id, $owner_id, $user_id, $priority);
            header("Location: ".BASE_URL. "tasks");
        }
    }

    public function editTask(){
        $this->isLoggedIn(); 

        if(isset($_POST["title"], $_POST["details"], $_POST["site_id"], $_POST["user_id"], $_POST["priority"], $_POST["status"], $_POST["ulid"])){
            $title = $_POST["title"];
            $details = $_POST["details"];
            $site_id = $_POST["site_id"];
            $user_id = $_POST["user_id"];
            $priority = $_POST["priority"];
            $status = $_POST["status"];
            $ulid = $_POST["ulid"];

            $this->task->editTask($title, $details, $site_id, $user_id, $priority, $status, $ulid);
            header("Location: ".BASE_URL. "tasks");
        }

    }

    public function finishTask($params = []){
        $this->isLoggedIn();
        $ulid = $params[":ID"];
        $this->task->finishTask($ulid);
        header("Location: ".BASE_URL. "tasks");
    }

    public function deleteTask($params = []){
        $this->isLoggedIn();
        $ulid = $params[":ID"];
        $this->task->deleteTask($ulid);
        header("Location: ".BASE_URL. "tasks");
    }

    public function retakeTask($params = []){
        $this->isLoggedIn();
        $ulid = $params[":ID"];
        $this->task->retakeTask($ulid);
        header("Location: ".BASE_URL. "tasks");
    }

    public function updateTime(){
        $this->isLoggedIn();

        if(isset($_POST["ulid"], $_POST["time"])){
            $ulid = $_POST["ulid"];
            $time = intval($_POST["time"]);
            $this->task->updateTime($ulid, $time);
        }
    }
   
    public function showStatistics(){
        $this->isLoggedIn(); 
        $statistics = $this->task->getStatistics();
        $this->view->showStatistics($statistics);
    }

}
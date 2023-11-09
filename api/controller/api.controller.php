<?php

require_once "./view/api.view.php";

abstract class APIController{
    protected $view;
    private $data;

    protected function __construct(){
        $this->view = new APIView();
        $this->data = file_get_contents("php://input");
    }

    // protected function getData(){
    //     return json_decode($this->data);
    // }

    public function formatElapsedTime($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        // $remainingSeconds = $seconds % 60;
        // $formattedTime = sprintf("%02dh %02dm %02ds", $hours, $minutes, $remainingSeconds);
        $formattedTime = sprintf("%02dh %02dm", $hours, $minutes);
        return $formattedTime;
    }

}
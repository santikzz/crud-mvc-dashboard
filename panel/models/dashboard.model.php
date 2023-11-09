<?php

require_once "../database/database.php";

class DashboardModel
{

    private $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

}
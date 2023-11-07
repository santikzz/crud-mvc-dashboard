<?php

require_once "./database/database.php";
require_once('./libs/ulid-php/src/Ulid.php');

use Efarsoft\Ulid;

class TaskModel{

    private $db;

    public function __construct(){
        $this->db = db_connect();
    }

    public function getSites(){
        $stmt = $this->db->prepare("SELECT id, url, sitename FROM site");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUsers(){
        $stmt = $this->db->prepare("SELECT id, username FROM admin");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getTasks($user_id){
        $stmt = $this->db->prepare("SELECT t.id, t.title, t.details, t.priority, t.ulid, t.time, s.url, s.sitename, u_owner.username AS owner, u_user.username AS user, t.user_id, t.status
            FROM task t
            LEFT JOIN site s ON t.site_id = s.id
            LEFT JOIN admin u_owner ON t.owner_id = u_owner.id 
            LEFT JOIN admin u_user ON t.user_id = u_user.id
            WHERE t.user_id = :user_id AND t.status != 'FINISHED'
            ORDER BY t.ulid ASC;
        ");
        $stmt->execute(["user_id" => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function getFinishedTasks($user_id){
        $stmt = $this->db->prepare("SELECT t.id, t.title, t.details, t.priority, t.ulid, t.time, s.url, s.sitename, u_owner.username AS owner, u_user.username AS user, t.user_id, t.status
            FROM task t
            LEFT JOIN site s ON t.site_id = s.id
            LEFT JOIN admin u_owner ON t.owner_id = u_owner.id 
            LEFT JOIN admin u_user ON t.user_id = u_user.id
            WHERE t.user_id = :user_id AND t.status = 'FINISHED'
            ORDER BY t.ulid ASC;
        ");
        $stmt->execute(["user_id" => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function createTask($title, $details, $site_id, $owner_id, $user_id, $priority){
        
        $ulid = Ulid::generate(true);

        $stmt = $this->db->prepare("INSERT INTO task (title, site_id, details, priority, ulid, time, owner_id, user_id, status) 
            VALUES (:title, :site_id, :details, :priority, :ulid, :time, :owner_id, :user_id, :status )");
            $stmt->execute([
                "title" => $title,
                "site_id" => $site_id,
                "details" => $details,
                "priority" => $priority,
                "ulid" => $ulid, 
                "time" => 0,
                "owner_id" => $owner_id,
                "user_id" => $user_id,
                "status" => "PENDING"
            ]);
            return ($stmt->rowCount() > 0);
    }

    public function editTask($title, $details, $site_id, $user_id, $priority, $status, $ulid){
        $stmt = $this->db->prepare("UPDATE task SET
            title = :title,
            details = :details,
            side_id = :site_id,
            user_id = :user_id,
            priority = :priority,
            status = :status
            WHERE ulid = :ulid
        ");
        $stmt->execute(["title"=> $title, "details" => $details, "site_id" => $site_id, "user_id" => $user_id, "priority" => $priority, "status" => $status, "ulid" => $ulid]);
        return ($stmt->rowCount() > 0);
    }

    public function finishTask($task_ulid){
        $stmt = $this->db->prepare("UPDATE task SET status='FINISHED' WHERE ulid = :ulid");
        $stmt->execute(["ulid" => $task_ulid]);
        return ($stmt->rowCount() > 0);
    }

    public function deleteTask($task_ulid){
        $stmt = $this->db->prepare("DELETE FROM task WHERE ulid = :ulid");
        $stmt->execute(["ulid" => $task_ulid]);
        return ($stmt->rowCount() > 0);
    } 

    public function retakeTask($task_ulid){
        $stmt = $this->db->prepare("UPDATE task SET status='PROGRESS' WHERE ulid = :ulid");
        $stmt->execute(["ulid" => $task_ulid]);
        return ($stmt->rowCount() > 0);
    } 

    public function updateTime($task_ulid, $time){
        $stmt = $this->db->prepare("UPDATE task SET 
            time = time + :time, 
            status = CASE WHEN status = 'PENDING' THEN 'PROGRESS' else status END 
            WHERE ulid = :ulid AND status != 'FINISHED'
        ");
        $stmt->execute(["time" => $time, "ulid" => $task_ulid]);
        return ($stmt->rowCount() > 0);
    }

    public function getStatistics(){
        $stmt = $this->db->prepare("SELECT s.sitename, 
            COUNT(*) AS total_tasks, 
            SUM(CASE WHEN t.status = 'FINISHED' THEN 1 ELSE 0 END) as finished_tasks, 
            SUM(t.time) AS total_time 
            FROM task t
            LEFT JOIN site s ON t.site_id = s.id
            GROUP BY t.site_id
            ORDER BY total_time ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}


<?php

require_once "../database/database.php";
require_once('./libs/ulid-php/src/Ulid.php');

use Efarsoft\Ulid;

class LicenseModel{

    private $db;

    public function __construct(){
        $this->db = db_connect();
    }

    public function getLicenses(){
        $stmt = $this->db->prepare("SELECT k.id, p.name AS product_name, k.product_key, k.hwid, k.duration, k.lifetime, k.activation_date, k.status, k.description, k.banned FROM licence k
        LEFT JOIN product p ON k.product_id = p.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProducts(){
        $stmt = $this->db->prepare("SELECT p.id, p.game_id, g.name AS game_name, p.name AS product_name FROM product p
        LEFT JOIN game g ON p.game_id = g.id
        ORDER BY game_name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getGames(){
        $stmt = $this->db->prepare("SELECT id, name, image FROM game");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createLicense($product_id, $duration, $time_modifier, $description){
        
        $isLifetime = 0;
        switch ($time_modifier){
            case "time_hours":
                $calculated_duration = $duration*3600;
                break;
            case "time_days":
                $calculated_duration = $duration*93600;
                break;
            case "time_lifetime":
                $calculated_duration = -1;
                $isLifetime = 1;
                break;
            default:
                $calculated_duration = 0;
                break;
        }
        
        $product_key = Ulid::generate();

        $stmt = $this->db->prepare("INSERT INTO licence (user_id, product_id, product_key, hwid, duration, lifetime, activation_date, status, description, banned) 
        VALUES (0, :product_id, :product_key, 'none', :duration, :lifetime, 0, 'UNUSED', :description, 0)");
        $stmt->execute([
            "product_id" => $product_id,
            "product_key" => $product_key,
            "duration" => $calculated_duration,
            "lifetime" => $isLifetime,
            "description" => $description
        ]);
        return ($stmt->rowCount() > 0);
    }

    public function deleteLicense($key_id){
        $stmt = $this->db->prepare("DELETE FROM licence WHERE id = :key_id");
        $stmt->execute(["key_id" => $key_id]);
        return ($stmt->rowCount() > 0);
    }

    public function getLicenceData($key_id){
        $stmt = $this->db->prepare("SELECT k.id, k.product_id, k.product_key, p.name AS product_name, g.name AS game_name, k.hwid, k.duration, k.lifetime, k.activation_date, k.status, k.description, k.banned FROM licence k
            LEFT JOIN product p ON k.product_id = p.id
            LEFT JOIN game g ON p.game_id = g.id
            WHERE k.id = :key_id
        ");
        $stmt->execute(["key_id" => $key_id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        echo json_encode($data);
    }

}


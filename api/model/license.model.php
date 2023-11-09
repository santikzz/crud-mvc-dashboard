<?php

require_once "../database/database.php";

class APILicenseModel
{

    private $db;

    public function __construct()
    {
        $this->db = db_connect();
    }
    public function getLicenseData($license){
        $stmt = $this->db->prepare("SELECT k.id, p.name AS product_name, k.product_key, k.hwid, k.duration, k.lifetime, k.activation_date, k.status, k.description, k.banned FROM licence k
            LEFT JOIN product p ON k.product_id = p.id
            WHERE k.product_key = :license
        ");
        $stmt->execute(["license" => $license]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function setLicenseStatus($license, $status){
        $stmt = $this->db->prepare("UPDATE licence SET status = :status WHERE product_key = :license");
        $stmt->execute(["license"=> $license, "status" => $status]);
        return $stmt->rowCount();
    }
    
    // public function deleteMovie($id)
    // {
    //     $stmt = $this->db->prepare("DELETE FROM `pelicula` WHERE `id` = :id");
    //     $stmt->execute(["id" => $id]);
    // }

    // public function updateMovie($title, $genre_id, $author, $image, $id)
    // {
    //     $stmt = $this->db->prepare("UPDATE `pelicula` SET `nombre` = :nombre, `id_genero` = :id_genero, `autor` = :autor, `image` = :imageurl WHERE `id` = :id ");
    //     $stmt->execute(["nombre" => $title, "id_genero" => $genre_id, "autor" => $author, "imageurl" => $image, "id" => $id]);
    // }




}
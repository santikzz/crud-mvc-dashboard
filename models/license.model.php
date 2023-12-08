<?php

require_once "../database/database.php";
require_once('./libs/ulid-php/src/Ulid.php');

use Efarsoft\Ulid;

class LicenseModel
{

    private $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getLicenses()
    {
        $stmt = $this->db->prepare("SELECT k.id, p.name AS product_name, k.product_key, k.hwid, k.duration, k.lifetime, k.activation_date, k.status, k.description, k.banned FROM licence k
        LEFT JOIN product p ON k.product_id = p.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProducts()
    {
        $stmt = $this->db->prepare("SELECT p.id, p.game_id, g.name AS game_name, p.name AS product_name FROM product p
        LEFT JOIN game g ON p.game_id = g.id
        ORDER BY game_name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getGames()
    {
        $stmt = $this->db->prepare("SELECT id, name, image FROM game");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createLicense($product_id, $duration, $time_modifier, $description)
    {

        $isLifetime = 0;
        switch ($time_modifier) {
            case "time_hours":
                $calculated_duration = $duration * 3600;
                break;
            case "time_days":
                $calculated_duration = $duration * 93600;
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

        $stmt = $this->db->prepare("INSERT INTO licence (created_by, product_id, product_key, hwid, duration, lifetime, activation_date, status, description, banned) 
        VALUES (1, :product_id, :product_key, 'none', :duration, :lifetime, 0, 'UNUSED', :description, 0)");
        $stmt->execute([
            "product_id" => $product_id,
            "product_key" => $product_key,
            "duration" => $calculated_duration,
            "lifetime" => $isLifetime,
            "description" => $description
        ]);
        return ($stmt->rowCount() > 0);
    }

    public function deleteLicense($key_id)
    {
        $stmt = $this->db->prepare("DELETE FROM licence WHERE id = :key_id");
        $stmt->execute(["key_id" => $key_id]);
        return ($stmt->rowCount() > 0);
    }

    public function getLicenceData($key_id)
    {
        $stmt = $this->db->prepare("SELECT k.id, k.product_id, k.product_key, p.name AS product_name, g.name AS game_name, k.hwid, k.duration, k.lifetime, k.activation_date, k.status, k.description, k.banned FROM licence k
            LEFT JOIN product p ON k.product_id = p.id
            LEFT JOIN game g ON p.game_id = g.id
            WHERE k.id = :key_id
        ");
        $stmt->execute(["key_id" => $key_id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        echo json_encode($data);
    }

    public function addGame($name)
    {
        $stmt = $this->db->prepare("INSERT INTO game (name) VALUES (:name)");
        $stmt->execute(["name" => $name]);
        return ($stmt->rowCount() > 0);
    }

    public function addProduct($game_id, $name)
    {
        $stmt = $this->db->prepare("INSERT INTO product (game_id, name) VALUES (:game_id, :name)");
        $stmt->execute(["game_id" => $game_id, "name" => $name]);
        return ($stmt->rowCount() > 0);
    }

    public function deleteGame($id)
    {
        $stmt = $this->db->prepare("DELETE FROM game WHERE id = :id");
        $stmt->execute(["id" => $id]);
        return ($stmt->rowCount() > 0);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM product WHERE id = :id");
        $stmt->execute(["id" => $id]);
        return ($stmt->rowCount() > 0);
    }

    public function getPublicProductList()
    {
        $stmt = $this->db->prepare("SELECT c.id, c.name, c.version, c.status, c.filename, c.visible, g.id as 'game_id', p.name AS 'product_id_name', g.name as 'game_name', g.image FROM public_list c
            LEFT JOIN product p ON c.product_id = p.id
            LEFT JOIN game g ON p.game_id = g.id
            ORDER BY g.name ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addPublicItem($product_id, $name, $version, $status, $visible, $filename, $size)
    {

        $stmt = $this->db->prepare("INSERT INTO public_list (name, version, status, filename, product_id, visible, size, pricing) VALUES
            (:name, :version, :status, :filename, :product_id, :visible, :size, '')
        ");
        $stmt->execute(["product_id" => $product_id, "name" => $name, "version" => $version, "status" => $status, "visible" => $visible, "filename" => $filename, "size" => $size]);
        return ($stmt->rowCount() > 0);
    }

    public function getPublicItemId($item_id)
    {
        $stmt = $this->db->prepare("SELECT id, name, version, status, filename, product_id, visible, size, pricing FROM public_list WHERE id = :item_id");
        $stmt->execute(["item_id" => $item_id]);
        return $stmt->fetch(PDO::FETCH_OBJ);

    }

    public function getGameId($item_id)
    {
        $stmt = $this->db->prepare("SELECT id, name, image FROM game WHERE id = :item_id");
        $stmt->execute(["item_id" => $item_id]);
        return $stmt->fetch(PDO::FETCH_OBJ);

    }

    public function getProductId($item_id)
    {
        $stmt = $this->db->prepare("SELECT id, game_id, name FROM product WHERE id = :item_id");
        $stmt->execute(["item_id" => $item_id]);
        return $stmt->fetch(PDO::FETCH_OBJ);

    }

    public function updatePublicItem($item_id, $product_id, $name, $version, $status, $visible, $filename, $size){
    $stmt = $this->db->prepare("UPDATE public_list SET name = :name, version = :version, status = :status, 
        filename = CASE WHEN :filename <> '' THEN :filename ELSE filename END,
        size = CASE WHEN :size <> '' THEN :size ELSE size END,
        product_id = :product_id, visible = :visible
        WHERE id = :item_id
    ");
        $stmt->execute(["item_id" => $item_id, "product_id" => $product_id, "name" => $name, "version" => $version, "status" => $status, "visible" => $visible, "filename" => $filename, "size" => $size]);
        return ($stmt->rowCount() > 0);
    }

    public function updateGameId($id, $name, $image){
        $stmt = $this->db->prepare("UPDATE game SET name = :name, image = :image WHERE id = :id");
        $stmt->execute(["id"=>$id, "name" => $name, "image" => $image]);
        return ($stmt->rowCount() > 0);
    }

    public function updateProductId($id, $game_id, $name){
        $stmt = $this->db->prepare("UPDATE product SET game_id = :game_id, name = :name WHERE id = :id");
        $stmt->execute(["id"=>$id, "game_id" => $game_id, "name" => $name]);
        return ($stmt->rowCount() > 0);
    }

    public function deletePublicItem($id){
        $stmt = $this->db->prepare("DELETE FROM public_list WHERE id = :id");
        $stmt->execute(["id" => $id]);
        return ($stmt->rowCount() > 0);
    }

    public function resetHwid($key_id){
        $stmt = $this->db->prepare("UPDATE licence SET hwid = 'RESET' WHERE id = :KEY_ID");
        $stmt->execute(["KEY_ID" => $key_id]);
        return ($stmt->rowCount() > 0);
    }

}


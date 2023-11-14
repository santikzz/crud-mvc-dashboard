<?php

require_once "../database/database.php";

class APILicenseModel
{

    private $db;

    public function __construct()
    {
        $this->db = db_connect();
    }
    public function getLicenseData($license)
    {
        $stmt = $this->db->prepare("SELECT k.id, p.name AS product_name, k.product_key, k.hwid, k.duration, k.lifetime, k.activation_date, k.status, k.description, k.banned FROM licence k
            LEFT JOIN product p ON k.product_id = p.id
            WHERE k.product_key = :license
        ");
        $stmt->execute(["license" => $license]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function setLicenseStatus($license, $status)
    {
        $stmt = $this->db->prepare("UPDATE licence SET status = :status WHERE product_key = :license");
        $stmt->execute(["license" => $license, "status" => $status]);
        return $stmt->rowCount();
    }

    public function activateLicense($license, $hwid)
    {
        $stmt = $this->db->prepare("UPDATE licence SET status = 'USED', hwid = :hwid, activation_date = :activation_date WHERE product_key = :license");
        $stmt->execute(["license" => $license, "hwid" => $hwid, "activation_date" => time()]);
        return $stmt->rowCount();
    }

    public function banLicense($license)
    {
        $stmt = $this->db->prepare("UPDATE licence SET banned = 1 WHERE product_key = :license");
        $stmt->execute(["license" => $license]);
        // return $stmt->rowCount() > 0;
    }

    public function addBlacklistHwid($hwid, $detail)
    {
        // $stmt = $this->db->prepare("UPDATE licence SET banned = :banned WHERE hwid = :hwid");
        // $stmt->execute(["hwid"=> $hwid, "banned" => $state]);
        // return $stmt->rowCount();

        $stmt = $this->db->prepare("SELECT hwid FROM blacklist WHERE hwid = :hwid");
        $stmt->execute(["hwid" => $hwid]);

        if ($stmt->rowCount() == 0) {
            $stmt = $this->db->prepare("INSERT INTO blacklist (hwid, detail) VALUES (:hwid, :detail)");
            $stmt->execute(["hwid" => $hwid, "detail" => $detail]);
        }

        // return $stmt->rowCount() > 0;
    }

}
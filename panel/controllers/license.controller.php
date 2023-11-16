<?php

require_once "./controllers/dashboard.controller.php";
require_once "./models/license.model.php";

class LicenseController extends DashboardController
{
    private $licenseModel;

    public function __construct()
    {
        parent::__construct();
        $this->licenseModel = new LicenseModel();
    }

    public function showLicenses()
    {
        $this->isLoggedIn();
        $products = $this->licenseModel->getProducts();
        $licenses = $this->licenseModel->getLicenses();
        $this->view->showLicenses($licenses, $products);
    }

    public function showProducts()
    {
        $this->isLoggedIn();
        $games = $this->licenseModel->getGames();
        $products = $this->licenseModel->getProducts();
        $this->view->showProducts($games, $products);
    }

    public function createLicense()
    {
        $this->isLoggedIn();

        if (isset($_POST["key_product_id"], $_POST["key_time_modifier"], $_POST["key_time"], $_POST["key_description"])) {

            $product_id = $_POST["key_product_id"];
            $duration = $_POST["key_time"];
            $time_modifier = $_POST["key_time_modifier"];
            $description = $_POST["key_description"];

            $this->licenseModel->createLicense($product_id, $duration, $time_modifier, $description);
        }
        header("Location: " . BASE_URL . "licenses");
    }

    public function deleteLicense($params = [])
    {
        $this->isLoggedIn();
        $key_id = $params[":ID"];
        $this->licenseModel->deleteLicense($key_id);
        header("Location: " . BASE_URL . "licenses");
    }

    public function getLicenceData($params = [])
    {
        $this->isLoggedIn();
        $key_id = $params[":ID"];
        $this->licenseModel->getLicenceData($key_id);
    }

    public function addGame($params = [])
    {
        $this->isLoggedIn();
        if (isset($_POST["name"])) {
            $name = $_POST["name"];
            $this->licenseModel->addGame($name);
            header("Location: " . BASE_URL . "products");
        }

    }

    public function addProduct($params = [])
    {
        $this->isLoggedIn();
        if (isset($_POST["game_id"], $_POST["name"])) {
            $game_id = $_POST["game_id"];
            $name = $_POST["name"];
            $this->licenseModel->addProduct($game_id, $name);
        }
        header("Location: " . BASE_URL . "products");

    }
    
    public function deleteGame($params = []){
        $this->isLoggedIn();
        $id = $params[":ID"];
        if($id){
            $this->licenseModel->deleteGame($id);
        }
        header("Location: " . BASE_URL . "products");
    }

    public function deleteProduct($params = []){
        $this->isLoggedIn();
        $id = $params[":ID"];
        if($id){
            $this->licenseModel->deleteProduct($id);
        }
        header("Location: " . BASE_URL . "products");
    }


    public function editLicense()
    {
        $this->isLoggedIn();



    }

}
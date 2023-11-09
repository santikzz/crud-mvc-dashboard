<?php

require_once "./controllers/dashboard.controller.php";
require_once "./models/license.model.php";

class LicenseController extends DashboardController{
    private $licenseModel;

    public function __construct(){
        parent::__construct();
        $this->licenseModel = new LicenseModel();
    }

    public function showLicenses(){
        $this->isLoggedIn(); 
        $products = $this->licenseModel->getProducts();
        $licenses = $this->licenseModel->getLicenses();
        $this->view->showLicenses($licenses, $products);
    }

    public function createLicense(){
        $this->isLoggedIn(); 
        
        if(isset($_POST["key_product_id"], $_POST["key_time_modifier"], $_POST["key_time"], $_POST["key_description"])){
            
            $product_id = $_POST["key_product_id"];
            $duration = $_POST["key_time"];
            $time_modifier = $_POST["key_time_modifier"];
            $description = $_POST["key_description"];             
            
            $this->licenseModel->createLicense($product_id, $duration, $time_modifier, $description);
        }
        header("Location: ".BASE_URL. "licenses");
    }

    public function deleteLicense($params = []){
        $this->isLoggedIn();
        $key_id = $params[":ID"];
        $this->licenseModel->deleteLicense($key_id);
        header("Location: ".BASE_URL. "licenses");
    }

    public function getLicenceData($params = []){
        $this->isLoggedIn();
        $key_id = $params[":ID"];
        $this->licenseModel->getLicenceData($key_id);
    }

   public function editLicense(){
    $this->isLoggedIn();



   }

}
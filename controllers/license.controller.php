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
        $public_list = $this->licenseModel->getPublicProductList();
        $this->view->showProducts($games, $products, $public_list);
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

    public function deleteGame($params = [])
    {
        $this->isLoggedIn();
        $id = $params[":ID"];
        if ($id) {
            $this->licenseModel->deleteGame($id);
        }
        header("Location: " . BASE_URL . "products");
    }

    public function deleteProduct($params = [])
    {
        $this->isLoggedIn();
        $id = $params[":ID"];
        if ($id) {
            $this->licenseModel->deleteProduct($id);
        }
        header("Location: " . BASE_URL . "products");
    }

    public function addPublicItem()
    {
        $this->isLoggedIn();

        if (isset($_POST["product_id"], $_POST["name"], $_POST["version"], $_POST["status"], $_POST["visible"])) {

            $product_id = $_POST["product_id"];
            $name = $_POST["name"];
            $version = $_POST["version"];
            $status = $_POST["status"];
            $visible = $_POST["visible"];

            $filename = "";
            $size = "0.0 MB";

            if (isset($_FILES["upload_file"])) {

                $file = $_FILES["upload_file"];
                $filename = basename($file["name"]);
                $target_file = UPLOAD_DIR . $filename;

                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    $size = $file["size"] / (1024 * 1024); // to MB
                    $size = number_format((float) $size, 2, '.', '');
                    $size .= " MB";
                }

            }

            $this->licenseModel->addPublicItem($product_id, $name, $version, $status, $visible, $filename, $size);
            header("Location: " . BASE_URL . "products");
        }

    }

    public function editPublicItem()
    {
        $this->isLoggedIn();

        if (isset($_POST["id"], $_POST["product_id"], $_POST["name"], $_POST["version"], $_POST["status"], $_POST["visible"])) {

            $id = $_POST["id"];
            $product_id = $_POST["product_id"];
            $name = $_POST["name"];
            $version = $_POST["version"];
            $status = $_POST["status"];
            $visible = $_POST["visible"];

            $filename = "";
            $size = "0.0 MB";

            if (isset($_FILES["upload_file"])) {

                $file = $_FILES["upload_file"];
                $filename = basename($file["name"]);
                $target_file = UPLOAD_DIR . $filename;

                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    $size = $file["size"] / (1024 * 1024); // to MB
                    $size = number_format((float) $size, 2, '.', '');
                    $size .= " MB";

                    if(isset($_POST["delete_old_file"])){
                        $old_filename = $this->licenseModel->getProductFilename($id);
                        unlink(UPLOAD_DIR . $old_filename);
                    }

                }

            }
            $this->licenseModel->updatePublicItem($id, $product_id, $name, $version, $status, $visible, $filename, $size);
            header("Location: " . BASE_URL . "products");
        }

    }

    public function editGameName()
    {
        $this->isLoggedIn();
        if (isset($_POST["id"], $_POST["name"])) {
            $id = $_POST["id"];
            $name = $_POST["name"];
            // TODO ADD IMAGE SUPPORT
            $image = "";
            $this->licenseModel->updateGameId($id, $name, $image);
        }
        header("Location: " . BASE_URL . "products");
    }

    public function editProduct()
    {
        $this->isLoggedIn();
        if (isset($_POST["id"], $_POST["game_id"], $_POST["name"])) {
            $id = $_POST["id"];
            $game_id = $_POST["game_id"];
            $name = $_POST["name"];
            $this->licenseModel->updateProductId($id, $game_id, $name);
        }
        header("Location: " . BASE_URL . "products");
    }

    public function deletePublicItem($params = [])
    {
        $this->isLoggedIn();
        $id = $params[":ID"];
        if ($id) {
            $this->licenseModel->deletePublicItem($id);
        }
        header("Location: " . BASE_URL . "products");
    }

    public function getPublicItemId($params = [])
    {
        $this->isLoggedIn();
        $id = $params[":ID"];
        echo json_encode($this->licenseModel->getPublicItemId($id));
    }

    public function getGameId($params = [])
    {
        $this->isLoggedIn();
        $id = $params[":ID"];
        echo json_encode($this->licenseModel->getGameId($id));
    }

    public function getProductId($params = [])
    {
        $this->isLoggedIn();
        $id = $params[":ID"];
        echo json_encode($this->licenseModel->getProductId($id));
    }

    public function editLicense($params = [])
    {
        $this->isLoggedIn();
        // TODO
    }

    public function resetHwid($params = [])
    {
        $this->isLoggedIn();
        $key_id = $params[":ID"];
        $this->licenseModel->resetHwid($key_id);
        header("Location: " . BASE_URL . "licenses");
    }

    public function getPricingId($params = [])
    {
        $this->isLoggedIn();
        $item_id = $params[":ID"];
        echo json_encode($this->licenseModel->getPricingId($item_id));
    }

    public function editPricing($params = [])
    {
        $this->isLoggedIn();
        if (isset($_POST["id"], $_POST["pricing_data"])) {
            $id = $_POST["id"];
            $data = $_POST["pricing_data"];
            $this->licenseModel->updatePricingId($id, $data);
        }
        header("Location: " . BASE_URL . "products");
    }

}
<?php

require_once "../config.php";
require_once "./controller/api.controller.php";
require_once "./model/license.model.php";
require_once "./helper/api.auth.helper.php";

class LicenseAPIController extends APIController
{

    private $model;
    private $auth;

    public function __construct()
    {
        parent::__construct();
        $this->model = new APILicenseModel();
        $this->auth = new APIAuthHelper();
    }

    public function getLicenseData($params = [])
    {

        // $user = $this->auth->getCurrentUser();
        // if (!$user) {
        //     $this->view->response(["error" => "unauthorized"], 401);
        //     return;
        // }

        if ($params[":KEY"]) {

            $key = $this->model->getLicenseData($params[":KEY"]);
            $hwid = $params[":HWID"];
            $product = $params[":PRODUCT"];

            if ($key) {

                // ===== expired or banned checks ===== //
                if ($key->product_name != $product) { // key for invalid product
                    $this->view->responseRaw("error_invalid_key");
                    return;
                }
                if ($key->banned == 1) { // banned key
                    $this->view->response(["status" => "banned"]);
                    return;
                }
                if ($key->hwid != $hwid) { // invalid hwid
                    $this->view->response(["status" => "invalid_hwid"]);
                    return;
                }
                if ($key->status == "EXPIRED") { // already expired
                    $this->view->response(["status" => "expired"]);
                    return;
                }
                // ===== end expired or banned checks ===== //

                // ACTIVATE LICENSE IF UNUSED (bind hwid)
                if ($key->status == "UNUSED") {
                    $this->model->activateLicense($key->product_key, $hwid);
                }

                // check if key is lifetime
                if ($key->lifetime == 1) {
                    $this->view->response(["status" => "valid", "lifetime" => 1, "remaining" => -1, "message" => "LIFETIME"], 200);
                    return;
                }

                $seconds_left = $key->activation_date + $key->duration - time(); // calc remaining seconds
                $time_left = $seconds_left > 0 ? $seconds_left : 0; // check if remaining seconds is > 0

                if ($time_left == 0) { // time = 0 then set expired
                    $this->view->response(["status" => "expired"], 200);
                    $this->model->setLicenseStatus($key->product_key, "EXPIRED");
                    return;
                }

                // default remaining time
                $this->view->response(["status" => "valid", "remaining" => $time_left, "message" => $this->formatElapsedTime($time_left)], 200);


            } else {
                // invalid key
                $this->view->response(["status" => "invalid_key"], 404);
            }

        }

    }

    public function getLegacyLicenseData($params = [])
    {

        if (isset($_POST["pkey"], $_POST["hwid"], $_POST["product"])) {

            $pkey = $_POST["pkey"];
            $hwid = $_POST["hwid"];
            $product = $_POST["product"];

            $key = $this->model->getLicenseData($pkey);

            if ($key) {

                // ===== expired or banned checks ===== //
                if ($key->product_name != $product) { // key for invalid product
                    $this->view->responseRaw("error_invalid_key");
                    return;
                }
                if ($key->banned == 1) { // banned key
                    $this->view->responseRaw("error_hwid_not_allowed");
                    return;
                }
                if ($key->hwid != "none" && $key->hwid != $hwid) { // invalid hwid
                    $this->view->responseRaw("error_hwid_not_allowed");
                    return;
                }
                if ($key->status == "EXPIRED") { // already expired
                    $this->view->responseRaw("error_expired_key");
                    return;
                }
                // ===== end expired or banned checks ===== //



                // ACTIVATE LICENSE IF UNUSED (bind hwid)
                if ($key->status == "UNUSED") {
                    $this->model->activateLicense($key->product_key, $hwid);

                    // check if key is lifetime
                    if ($key->lifetime == 1) {
                        $this->view->responseRaw("used_valid_key:9999999");
                        return;
                    }

                    $seconds_left = $key->duration; // calc remaining seconds
                    $time_left = $seconds_left > 0 ? $seconds_left : 0; // check if remaining seconds is > 0

                    $this->view->responseRaw("used_valid_key:" . $time_left);

                    return;
                }

                // check if key is lifetime
                if ($key->lifetime == 1) {
                    $this->view->responseRaw("used_valid_key:9999999");
                    return;
                }

                $seconds_left = $key->activation_date + $key->duration - time(); // calc remaining seconds
                $time_left = $seconds_left > 0 ? $seconds_left : 0; // check if remaining seconds is > 0

                if ($time_left == 0) { // time = 0 then set expired
                    $this->view->responseRaw("error_expired_key");
                    $this->model->setLicenseStatus($key->product_key, "EXPIRED");
                    return;
                }

                // default remaining time
                $this->view->responseRaw("used_valid_key:" . $time_left);

            } else {
                // invalid key
                $this->view->responseRaw("error_invalid_key");
            }

        }else{
            $this->view->responseRaw("error_no_data");
        }

    }

    public function blacklist($params = [])
    {

        $r1 = false;
        $r2 = false;

        if (isset($_POST["token"]) && $_POST["token"] === API_AUTH_TOKEN) {

            if (isset($_POST["license"])) {
                $license = $_POST["license"];
                $this->model->banLicense($license);
            }

            if (isset($_POST["hwid"], $_POST["detail"])) {
                $hwid = $_POST["hwid"];
                $detail = $_POST["detail"];
                $this->model->addBlacklistHwid($hwid, $detail);
            }

            // if($r1 || $r2) { $this->view->response(["status" => "banned"], 200); }

        }

    }

    // public function update($params = [])
    // {
    //     $id = $params[":ID"];
    //     $movie = $this->model->getMovie($id);

    //     if ($movie) {
    //         $data = $this->getData();
    //         $title = $data->title;
    //         $author = $data->author;
    //         $genre_id = $data->genre_id;
    //         $image_url = $data->image_url;

    //         $this->model->updateMovie($id, $title, $genre_id, $author, $image_url);

    //         $this->view->response(["message" => "message':'movie $id updated successfully"], 200);
    //     } else {
    //         $this->view->response(["error" => "movie $id not found"], 404);
    //     }
    // }


}
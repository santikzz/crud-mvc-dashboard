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

            if ($key) {

                // ===== expired or banned checks ===== //
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

                // check if key is lifetime
                if ($key->lifetime == 1) {
                    $this->view->response(["status" => "valid", "lifetime" => 1, "remaining" => -1, "message" => "LIFETIME"], 200);
                    return;
                }

                $seconds_left = $key->activation_date + $key->duration - time(); // calc remaining seconds
                $time_left = $seconds_left > 0 ? $seconds_left : 0; // check if remaining seconds is > 0

                // if unused, set to used
                if ($key->status == "UNUSED") {
                    // $this->view->response(["status" => "valid", "remaining" => $time_left], 200);
                    $this->model->setLicenseStatus($key->product_key, "USED");
                }

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
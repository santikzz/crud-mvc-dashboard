<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';
require_once './libs/router.php';

require_once './controller/license.api.controller.php';
require_once './controller/user.api.controller.php';

$router = new Router();

$router->addRoute('license/auth/:KEY/:HWID/:PRODUCT', 'GET', 'LicenseAPIController', 'getLicenseData');
$router->addRoute('license/blacklist', 'POST', 'LicenseAPIController', 'blacklist'); //$license, $hwid
$router->addRoute('api.php', 'POST', 'LicenseAPIController', 'getLegacyLicenseData'); // legacy api.php calls

// $router->addRoute('user/token', 'GET',    'UserAPIController', 'getToken');
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
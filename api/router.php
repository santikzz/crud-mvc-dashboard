<?php
    require_once '../config.php';
    require_once './libs/router.php';

    require_once './controller/license.api.controller.php';
    require_once './controller/user.api.controller.php';

    $router = new Router();

    $router->addRoute('license/auth/:KEY/:HWID',     'GET',    'LicenseAPIController', 'getLicenseData');
    $router->addRoute('license/blacklist',           'POST',   'LicenseAPIController', 'blacklist');        //$license, $hwid

    // $router->addRoute('user/token', 'GET',    'UserAPIController', 'getToken');
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
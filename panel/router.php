<?php

// enable error display
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../config.php';
require_once './libs/router.php';

require_once './controllers/dashboard.controller.php';
require_once './controllers/license.controller.php';
require_once './controllers/task.controller.php';
require_once "./models/task.model.php";

$router = new Router();

// DASHBOARD DEFAULTS //
$router->addRoute('home', 'GET', 'DashboardController', 'showDefault');

// USER AUTHENTICATION //
$router->addRoute('login', 'GET', 'DashboardController', 'showLogin');
$router->addRoute('logout', 'GET', 'AuthHelper', 'logout');
$router->addRoute('verify', 'POST', 'AuthHelper', 'verify');
// $router->addRoute('user/token', 'GET', 'UserAPIController', 'getToken'); // JWT TOKEN

// TASKS //
$router->addRoute('tasks',                  'GET',  'TaskController', 'showTasks');
$router->addRoute('tasks/create',           'POST', 'TaskController', 'createTask');
$router->addRoute('tasks/finish/:ID',       'GET',  'TaskController', 'finishTask');
$router->addRoute('tasks/retake/:ID',       'GET',  'TaskController', 'retakeTask');
$router->addRoute('tasks/edit',             'POST', 'TaskController', 'editTask');
$router->addRoute('tasks/delete/:ID',       'GET',  'TaskController', 'deleteTask');
$router->addRoute('tasks/updateTime',       'POST', 'TaskController', 'updateTime');
$router->addRoute('tasks/statistics',       'GET',  'TaskController', 'showStatistics');

// LICENSES
$router->addRoute('licenses',               'GET',  'LicenseController', 'showLicenses');
$router->addRoute('licenses/create',        'POST', 'LicenseController', 'createLicense');
$router->addRoute('licenses/delete/:ID',    'GET',  'LicenseController', 'deleteLicense');
$router->addRoute('licenses/getdata/:ID',   'GET',  'LicenseController', 'getLicenceData');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
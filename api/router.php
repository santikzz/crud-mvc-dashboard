<?php
    require_once 'config.php';
    require_once './libs/router.php';

    require_once './controller/license.api.controller.php';
    require_once './controller/user.api.controller.php';

    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('license/:KEY/:HWID',     'GET',    'LicenseAPIController', 'get');
    // $router->addRoute('movies',     'POST',   'MovieAPIController', 'create');
    // $router->addRoute('movies/:ID', 'GET',    'MovieAPIController', 'get'   );
    // $router->addRoute('movies/genre/:GENRE', 'GET',    'MovieAPIController', 'geByGenre');
    // $router->addRoute('movies/:ID', 'PUT',    'MovieAPIController', 'update');
    // $router->addRoute('movies/:ID', 'DELETE', 'MovieAPIController', 'delete');

    // $router->addRoute('genres',     'GET',    'MovieAPIController', 'getGenres'   );
    // $router->addRoute('genres',     'POST',   'GenreAPIController', 'create');
    // $router->addRoute('genres/:ID', 'GET',    'GenreAPIController', 'get'   );
    // $router->addRoute('genres/:ID', 'PUT',    'GenreAPIController', 'update');
    // $router->addRoute('genres/:ID', 'DELETE', 'GenreAPIController', 'delete');


    
    $router->addRoute('user/token', 'GET',    'UserAPIController', 'getToken');
    

    $router->route($_GET['resource']        , $_SERVER['REQUEST_METHOD']);
<?php

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('UPLOAD_DIR', '../downloads/');

const API_AUTH_TOKEN = '121d8087-9caf-4f17-afa8-c3cde8dc4c29';
const JWT_KEY = 'f01f626b-669e-4724-bbb8-8ececa8f94ef';
const JWT_EXP = 3600; // 1 hour
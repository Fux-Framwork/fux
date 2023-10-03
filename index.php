<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap/app.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Services\Utils\EmptyRequestFixService;

EmptyRequestFixService::fix();

include_routes();
include_packages_routes(2);
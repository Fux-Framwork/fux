<?php
require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Services\Utils\EmptyRequestFixService;

EmptyRequestFixService::fix();

/* Load external routes file */
foreach (rglob(__DIR__ . "/routes/*.php") as $filename) {
    include_once($filename);
}

/**
 * Load packages route files with the defined depth.
 * Default depth = 1
 * For example depth = 3 means that will be loaded all route files that match these following paths:
 * /app/Packages/{Folder}/Routes/*.php
 * /app/Packages/{Folder1}/{Folder2}/Routes/*.php
 * /app/Packages/{Folder1}/{Folder2}/{Folder3}/Routes/*.php
 */
for ($depth = 1; $depth <= 2; $depth++) {
    $pathSegments = str_repeat("/*", $depth);
    foreach (rglob(__DIR__ . "/app/Packages$pathSegments/Routes/*.php") as $filename) {
        include_once($filename);
    }
}
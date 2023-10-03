<?php

function include_routes()
{
    foreach (rglob(__DIR__ . "/../../routes/*.php") as $filename) {
        include_once($filename);
    }
}

/**
 * Load packages route files with the defined depth.
 * For example depth = 3 means that will be loaded all route files that match these following paths:
 * /app/Packages/{Folder}/Routes/*.php
 * /app/Packages/{Folder1}/{Folder2}/Routes/*.php
 * /app/Packages/{Folder1}/{Folder2}/{Folder3}/Routes/*.php
 *
 * @param int $maxDepth
 *
 * @return void
 */
function include_packages_routes(int $maxDepth = 2): void
{
    for ($depth = 1; $depth <= $maxDepth; $depth++) {
        $pathSegments = str_repeat("/*", $depth);
        foreach (rglob(__DIR__ . "/../../app/Packages$pathSegments/Routes/*.php") as $filename) {
            include_once($filename);
        }
    }
}
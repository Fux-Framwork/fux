<?php

$_PACKAGES_MANIFEST_FILES = [];
function getPackageVar($var, $package)
{
    global $_PACKAGES_MANIFEST_FILES;
    $manifest = $_PACKAGES_MANIFEST_FILES[$package] ?? include PROJECT_ROOT_DIR . "/app/Packages/$package/manifest.php";
    $_PACKAGES_MANIFEST_FILES[$package] = $manifest;
    return $manifest[$var] ?? null;
}


<?php

$__FUX_SERVICE_ARE_BOOTSTRAPPED = false;
function bootstrapServiceProviders()
{
    global $__FUX_SERVICE_ARE_BOOTSTRAPPED;
    $files = array_merge(rglob(PROJECT_ROOT_DIR . "/app/Packages/*/Services/*.php"), rglob(PROJECT_ROOT_DIR . "/services/*.php"));
    foreach ($files as $fileName) {
        include_once $fileName;
    }
    if (!$__FUX_SERVICE_ARE_BOOTSTRAPPED) {
        $classes = get_declared_classes();
        foreach ($classes as $className) {
            if (strpos($className, "Service")) {
                $implementations = class_implements($className);
                if (isset($implementations['IServiceProvider'])) {
                    $className::bootstrap();
                }
            }
        }
        $__FUX_SERVICE_ARE_BOOTSTRAPPED = true;
    }
}


$__FUX_SERVICE_ARE_DISPOSED = false;
function disposeServiceProviders()
{
    global $__FUX_SERVICE_ARE_DISPOSED, $__FUX_SERVICE_ARE_BOOTSTRAPPED;
    if (!$__FUX_SERVICE_ARE_DISPOSED && $__FUX_SERVICE_ARE_BOOTSTRAPPED) {
        $classes = get_declared_classes();
        foreach ($classes as $className) {
            if (strpos($className, "Service")) {
                $implementations = class_implements($className);
                if (isset($implementations['IServiceProvider'])) {
                    $className::dispose();
                }
            }
        }
        $__FUX_SERVICE_ARE_DISPOSED = true;
    }
}

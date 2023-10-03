<?php

/**
 * --------------------------------------------------------------------------
 * Importing config files
 * --------------------------------------------------------------------------
 * Importing all files that are inside /config or
 * /app/Packages/{PackageName}/Config directories
 */
foreach (glob(__DIR__ . '/../config/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/../app/Packages/*/Config/*.php') as $filename) {
    require_once $filename;
}


/**
 * --------------------------------------------------------------------------
 * Initializing a custom session handler if needed
 * --------------------------------------------------------------------------
 */

if (defined("SESSION_HANDLER_TYPE") && SESSION_HANDLER_TYPE == 'mysql') {
    require_once __DIR__ . '/Http/Session/MysqlSessionHandler.php';
    new \Fux\Http\Sessions\MysqlSessionHandler();
}


/**
 * --------------------------------------------------------------------------
 * Importing helpers functions
 * --------------------------------------------------------------------------
 * Recursively importing helpers functions
 */
foreach (rglob(__DIR__ . "/helpers/*.php") as $filename) {
    include_once($filename);
}


/**
 * --------------------------------------------------------------------------
 * Bootstrapping service providers
 * --------------------------------------------------------------------------
 * The following lines of codes are used to execute the "bootstrap" method of
 * all service providers. Furthermore, also their disposition is managed with
 * the built-in register_shutdown_function.
*/

bootstrapServiceProviders();
register_shutdown_function("disposeServiceProviders");


/**
 * --------------------------------------------------------------------------
 * Importing custom bootstrapping files
 * --------------------------------------------------------------------------
 * The following lines are used to import custom bootstrapping files. Those
 * files are useful in order to execute code once the application is
 * bootstrapped, service provider's bootstrap methods are executed.
 * For instances, you can set the default timezone of PHP's dates functions or
 * in your database connection.
 */
foreach (glob(__DIR__ . '/custom/*.php') as $filename) {
    require_once $filename;
}

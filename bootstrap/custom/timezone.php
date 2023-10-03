<?php

/**
 * --------------------------------------------------------------------------
 * Set PHP and Database timezone
 * --------------------------------------------------------------------------
 * The following lines of codes are used to sync PHP's timezone and database
 * timezone
 */

use Fux\Database\DB;

date_default_timezone_set('Europe/Rome');

if (DB_ENABLE) {
    $mins = (new DateTime())->getOffset() / 60;
    $sgn = ($mins < 0 ? -1 : 1);
    $mins = abs($mins);
    $hrs = floor($mins / 60);
    $mins -= $hrs * 60;
    $offset = sprintf('%+d:%02d', $hrs * $sgn, $mins);

    DB::ref()->set_charset("utf8");
    DB::ref()->query("SET SESSION sql_mode = 'ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
    DB::ref()->query("SET time_zone='$offset'");
}
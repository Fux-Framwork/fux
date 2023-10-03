<?php

function redirect($route)
{
    header("Location: " . PROJECT_HTTP_SCHEMA . "://" . DOMAIN_NAME . PROJECT_DIR . $route);
    exit;
}

function redirect301($route)
{
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . PROJECT_HTTP_SCHEMA . "://" . DOMAIN_NAME . PROJECT_DIR . $route);
    exit;
}

function routeFullUrl($route)
{
    return PROJECT_HTTP_SCHEMA . "://" . DOMAIN_NAME . PROJECT_DIR . $route;
}
<?php


use Fux\Database\DB;

function sanitize_post()
{
    global $_POST_SANITIZED;
    if ($_POST_SANITIZED) return;
    array_walk_recursive($_POST, function (&$leaf) {
        if (is_string($leaf))
            $leaf = DB_ENABLE ? DB::sanitize($leaf) : filter_var($leaf, FILTER_SANITIZE_SPECIAL_CHARS);
    });
    $_POST_SANITIZED = true;
}


function sanitize_get()
{
    global $_GET_SANITIZED;
    if ($_GET_SANITIZED) return;
    array_walk_recursive($_GET, function (&$leaf) {
        if (is_string($leaf))
            $leaf = DB_ENABLE ? DB::sanitize($leaf) : filter_var($leaf, FILTER_SANITIZE_SPECIAL_CHARS);
    });
    $_GET_SANITIZED = true;
}

function sanitize_request()
{
    global $_REQUEST_SANITIZED;
    if ($_REQUEST_SANITIZED) return;
    array_walk_recursive($_REQUEST, function (&$leaf) {
        if (is_string($leaf))
            $leaf = DB_ENABLE ? DB::sanitize($leaf) : filter_var($leaf, FILTER_SANITIZE_SPECIAL_CHARS);
    });
    $_REQUEST_SANITIZED = true;
}


function sanitize_object(&$object)
{
    array_walk_recursive($object, function (&$leaf) {
        if (is_string($leaf))
            $leaf = DB_ENABLE ? DB::sanitize($leaf) : filter_var($leaf, FILTER_SANITIZE_SPECIAL_CHARS);
    });
}

function sanitize_html($html)
{
    $ALLOWED_HTML_TAGS = ['p', 'b', 'u', 'br', 'i', 'font', 'span'];
    return strip_tags(html_entity_decode($html), "<" . implode('><', $ALLOWED_HTML_TAGS) . ">");
}


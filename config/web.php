<?php
/* GLOBAL VARIABLES */

include_once (__DIR__."/environment.php");

/** @MARK Project information */
const BRAND_NAME = "FuxFramework";
const PROJECT_NAME = "FuxFramework";
const OWNER_NAME = "FuxFramework";

/** @MARK Project information */
define("ROOT_DIR",$_SERVER['DOCUMENT_ROOT']);
const PROJECT_ROOT_DIR = ROOT_DIR . PROJECT_DIR;
const PROJECT_VIEWS_DIR = PROJECT_ROOT_DIR . '/views';
const PROJECT_MODELS_DIR = PROJECT_ROOT_DIR . '/models';

define("PROJECT_URL", PROJECT_HTTP_SCHEMA."://".$_SERVER['SERVER_NAME'].PROJECT_DIR);


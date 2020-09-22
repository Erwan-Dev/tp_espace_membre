<?php

$root = __DIR__;

include_once $root . "/partials/header.php";
include_once $root . "/partials/navbar.php";

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url_segments = explode("/", $url_path);

if ($url_segments[2] === "inscription"){
    var_dump("test");
}

include_once $root . "/partials/footer.php";
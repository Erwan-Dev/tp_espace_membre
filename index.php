<?php

$root = __DIR__;

include_once $root . '/Request.php';
include_once $root . '/Router.php';
include_once $root . "/partials/header.php";
include_once $root . "/partials/navbar.php";

$router = new Router( new Request() );

$router->get('/inscription', function () {
    include_once __DIR__ . '/views/inscription.php';
});

$router->get('/connexion', function () {
    include_once __DIR__ . '/views/connexion.php';
});

$router->get('/deconnexion', function () {
    include_once __DIR__ . '/views/deconnexion.php';
});


include_once $root . "/partials/footer.php";
<?php

use public_html\Controller\MomentsDayController;


$parse_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($parse_uri) {

    case "/":
        MomentsDayController::form();
        break;

    case "/visitas":
        MomentsDayController::visitas();
        break;

    default:
        header('location: /');
        break;
}

<?php

require_once __DIR__ . "/AutoLoader.php";

use lib\MVC\Responder;
use lib\MVC\View;

require_once __DIR__ . '/lib/MVC/RouteList.php';

$kernel = new Responder(View::getURI());
$kernel->response();
$kernel->execute();

<?php

require_once __DIR__ . '/autoload.php';

use App\Controllers\HomeController;

$controller = new HomeController();
$controller->index();
<?php

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

use Api\Controllers\HttpController;
use Dotenv\Dotenv;

HttpController::headers();

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

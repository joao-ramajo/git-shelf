<?php

declare(strict_types=1);

require_once dirname(__DIR__, 1) . '/config/bootstrap.php';
require_once dirname(__DIR__, 1) . '/routes/web.php';

$router->dispatch();


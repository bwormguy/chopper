<?php
declare(strict_types = 1);

use Chopper\Component\Console\Command\CommandsHandler;

require_once __DIR__ . '/../configs/composer-autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/config.php';

//Todo
CommandsHandler::main();
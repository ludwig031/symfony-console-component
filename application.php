<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use ZgPHP\Console\Command\HelloWorldCommand;

$application = new Application();

$command = new HelloWorldCommand();
$application->add($command);

$application->run();

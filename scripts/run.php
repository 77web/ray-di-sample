#!/usr/bin/env php
<?php

use Quartetcom\RayDiSample\Command\GreetingCommand;
use Quartetcom\RayDiSample\DependencyInjection\GreeterModule;
use Ray\Di\Injector;
use Symfony\Component\Console\Application;

require __DIR__.'/../vendor/autoload.php';

ini_set('date.timezone', 'Asia/Tokyo');
if (!getenv('lang')) {
    putenv('lang=de');
}

$injector = new Injector(new GreeterModule());
$command = $injector->getInstance(GreetingCommand::class);

$app = new Application();
$app->add($command);
$app->setDefaultCommand($command->getName(), true);

$app->run();

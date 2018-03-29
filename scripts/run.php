#!/usr/bin/env php
<?php

use PHPMentors\DomainCommons\DateTime\Clock;
use Psr\Log\NullLogger;
use Quartetcom\RayDiSample\Command\GreetingCommand;
use Quartetcom\RayDiSample\Greeter;
use Quartetcom\RayDiSample\GreetingFormatter;
use Quartetcom\RayDiSample\GreetingRegistry;
use Quartetcom\RayDiSample\TimeDetector;
use Symfony\Component\Console\Application;
use Symfony\Component\Yaml\Yaml;

require __DIR__.'/../vendor/autoload.php';

ini_set('date.timezone', 'Asia/Tokyo');
if (!getenv('lang')) {
    putenv('lang=de');
}

$timeDetector = TimeDetector::createFromConfig([
    'morning' => range(4, 10),
    'day' => range(11, 15),
    'night' => array_merge(range(0, 3), range(16, 23)),
]);
$greetings = Yaml::parseFile(__DIR__.'/../src/Resources/config/greetings.yml')['greetings'];
$lang = getenv('lang');
$greetRegistry = new GreetingRegistry($greetings[$lang]);
$greeter = new Greeter($greetRegistry, $timeDetector, new GreetingFormatter('%greeting%, %name%.'), new Clock());
$command = new GreetingCommand($greeter, new NullLogger());

$app = new Application();
$app->add($command);
$app->setDefaultCommand($command->getName(), true);

$app->run();

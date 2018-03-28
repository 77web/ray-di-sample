<?php

namespace Quartetcom\RayDiSample\DependencyInjection;

use PHPMentors\DomainCommons\DateTime\Clock;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Quartetcom\RayDiSample\Command\GreetingCommand;
use Quartetcom\RayDiSample\Greeter;
use Quartetcom\RayDiSample\GreetingFormatter;
use Quartetcom\RayDiSample\GreetingRegistry;
use Quartetcom\RayDiSample\TimeDetector;
use Ray\Di\AbstractModule;
use Symfony\Component\Yaml\Yaml;

class GreeterModule extends AbstractModule
{
    protected function configure()
    {

        $this->bind(TimeDetector::class)->toInstance(TimeDetector::createFromConfig([
            'morning' => range(4, 10),
            'day' => range(11, 15),
            'night' => array_merge(range(0, 3), range(16, 23)),
        ]));
        $this->bind(Clock::class);
        $this->bind(Greeter::class);

        $this->bind(GreetingFormatter::class)->toConstructor(GreetingFormatter::class, [
            'format' => 'greeting_formatter_format',
        ]);
        $this->bind()->annotatedWith('greeting_formatter_format')->toInstance('%greeting%, %name%.');

        $this->bind(GreetingRegistry::class)->toProvider(GreetingRegistryProvider::class, getenv('lang'));
        $this->bind()->annotatedWith('greeting_registry_greetings')->toInstance(Yaml::parseFile(__DIR__.'/../Resources/config/greetings.yml')['greetings']);

        $this->bind(LoggerInterface::class)->to(NullLogger::class);
        $this->bind(GreetingCommand::class);
    }
}

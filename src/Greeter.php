<?php


namespace Quartetcom\RayDiSample;


use PHPMentors\DomainCommons\DateTime\Clock;

class Greeter
{
    /**
     * @var GreetingRegistry
     */
    private $greetingRegistry;

    /**
     * @var TimeDetector
     */
    private $timeDetector;

    /**
     * @var GreetingFormatter
     */
    private $formatter;
    
    /**
     * @var Clock
     */
    private $clock;

    /**
     * @param GreetingRegistry $greetingRegistry
     * @param TimeDetector $timeDetector
     * @param GreetingFormatter $formatter
     * @param Clock $clock
     */
    public function __construct(
        GreetingRegistry $greetingRegistry,
        TimeDetector $timeDetector,
        GreetingFormatter $formatter,
        Clock $clock
    ) {
        $this->greetingRegistry = $greetingRegistry;
        $this->timeDetector = $timeDetector;
        $this->formatter = $formatter;
        $this->clock = $clock;
    }

    public function greet(string $name)
    {
        $time = $this->timeDetector->detect($this->clock->now());

        return $this->formatter->format($this->greetingRegistry->getGreetingForTime($time), $name);
    }
}

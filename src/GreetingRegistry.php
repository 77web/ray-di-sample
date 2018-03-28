<?php


namespace Quartetcom\RayDiSample;


use Symfony\Component\Yaml\Yaml;

class GreetingRegistry
{
    /**
     * @var string[]
     */
    private $greetings;

    /**
     * @param string[] $greetings
     */
    public function __construct(array $greetings)
    {
        $this->greetings = $greetings;
    }

    /**
     * @param string $time
     * @return string
     */
    public function getGreetingForTime(string $time)
    {
        if (!isset($this->greetings[$time])) {
            throw new \RuntimeException(sprintf('Time "%s" is not supported!', $time));
        }

        return $this->greetings[$time];
    }
}

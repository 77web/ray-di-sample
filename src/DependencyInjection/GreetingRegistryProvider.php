<?php


namespace Quartetcom\RayDiSample\DependencyInjection;


use Quartetcom\RayDiSample\GreetingRegistry;
use Ray\Di\Di\Named;
use Ray\Di\ProviderInterface;
use Ray\Di\SetContextInterface;

class GreetingRegistryProvider implements ProviderInterface, SetContextInterface
{
    /**
     * @var array
     */
    private $greetings;

    /**
     * @var string
     */
    private $context;

    /**
     * @Named("greetings=greeting_registry_greetings")
     * @param array $greetings
     */
    public function __construct(array $greetings)
    {
        $this->greetings = $greetings;
    }

    /**
     * @param string $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return GreetingRegistry
     */
    public function get()
    {
        return new GreetingRegistry($this->greetings[$this->context]);
    }
}

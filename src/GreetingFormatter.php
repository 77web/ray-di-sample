<?php


namespace Quartetcom\RayDiSample;


class GreetingFormatter
{
    /**
     * @var string
     */
    private $format;

    /**
     * @param string $format
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function format(string $greeting, string $name): string
    {
        return str_replace(['%greeting%', '%name%'], [$greeting, $name], $this->format);
    }
}

<?php


namespace Quartetcom\RayDiSample;


class TimeSetting
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int[]
     */
    private $range;

    /**
     * @param string $name
     * @param int[] $range
     */
    public function __construct(string $name, array $range)
    {
        $this->name = $name;
        $this->range = $range;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array|int[]
     */
    public function getTimeRange()
    {
        return $this->range;
    }

    /**
     * @param int $hour
     * @return bool
     */
    public function contains(int $hour)
    {
        return in_array($hour, $this->range, true);
    }
}

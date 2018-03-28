<?php


namespace Quartetcom\RayDiSample;


class TimeDetector
{
    /**
     * @var TimeSetting[]
     */
    private $timeSettings;

    /**
     * @param TimeSetting[] $timeSettings
     */
    public function __construct(array $timeSettings)
    {
        $this->assertValidSettings($timeSettings);

        $this->timeSettings = $timeSettings;
    }

    private function assertValidSettings(array $timeSettings)
    {
        $hours = [];
        foreach ($timeSettings as $timeSetting) {
            $hours = array_merge($hours, $timeSetting->getTimeRange());
        }

        if (count($hours) != 24) {
            throw new \LogicException('時間帯設定が不正です');
        }
    }

    public function detect(\DateTimeImmutable $datetime): string
    {
        $currentHour = (int)$datetime->format('G');
        foreach ($this->timeSettings as $timeSetting) {
            if ($timeSetting->contains($currentHour)) {
                return $timeSetting->getName();
            }
        }

        throw new \LogicException();
    }

    public static function createFromConfig(array $configs)
    {
        $settings = [];
        foreach ($configs as $name => $range) {
            $settings[] = new TimeSetting($name, $range);
        }

        return new self($settings);
    }
}

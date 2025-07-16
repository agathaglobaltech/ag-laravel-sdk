<?php

namespace AgathaGlobalTech\AnnuitiesGenius;

class FakeFactory
{
    public static function randomFloat(float $min, float $max, int $afterDot = 2): float
    {
        return round(
            random_int(round($min * pow(10, $afterDot)), round($max * pow(10, $afterDot))) / pow(10, $afterDot),
            $afterDot
        );
    }

    public static function randomElement(array $elements)
    {
        if (empty($elements)) {
            throw new \InvalidArgumentException('Cannot pick a random element from an empty array.');
        }

        return $elements[array_rand($elements)];
    }
}

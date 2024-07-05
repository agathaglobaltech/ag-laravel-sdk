<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

class Revenue
{
    public function __construct(
        public readonly float $earnings,
        public readonly float $endingValue,
    ) {}

    public static function fake()
    {
        return new self(
            earnings: mt_rand(),
            endingValue: mt_rand(),
        );
    }
}

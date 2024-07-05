<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use AgathaGlobalTech\AnnuitiesGenius\FakeFactory;

class DeathBenefit
{
    public function __construct(
        public readonly float $guaranteed,
        public readonly float $hypothetical
    ) {}

    public static function fake(array $override = [])
    {
        $params = [
            'guaranteed' => FakeFactory::randomFloat(1000, 10_000),
            'hypothetical' => FakeFactory::randomFloat(50_000, 1_000_000),
            ...$override,
        ];

        return new self(...$params);
    }
}

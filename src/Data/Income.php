<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use AgathaGlobalTech\AnnuitiesGenius\FakeFactory;

class Income
{
    public function __construct(
        public readonly float $guaranteedAnnualIncome,
        public readonly float $benefitBase,
        public readonly float $payoutRate,
    ) {
    }

    public function guaranteedMonthlyIncome(): float
    {
        return round($this->guaranteedAnnualIncome / 12);
    }

    public static function fake(array $override = [])
    {
        $params = [
            'guaranteedAnnualIncome' => FakeFactory::randomFloat(1000, 10_000),
            'benefitBase' => FakeFactory::randomFloat(50_000, 1_000_000),
            'payoutRate' => FakeFactory::randomFloat(0.1, 0.2),
            ...$override,
        ];

        return new self(...$params);
    }
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

class RiderData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $type,
        public readonly string $rollupRate,
        public readonly string $rollupPeriod,
        public readonly string $fee,
        public readonly bool $isInbuilt,
        public readonly float $benefitBaseBonus,
        public readonly int $deferYears,
        public readonly ?float $interestMultiplier,
        public readonly bool $hasIncreasingIncome,
        public readonly bool $hasEnhancedPayments,
        public readonly array $unavailableInStates,
        public readonly string $description,
    ) {
    }

    public static function parse(array $incomingRiderData)
    {
        return new self(
            id: $incomingRiderData['id'],
            name: $incomingRiderData['name'],
            type: $incomingRiderData['type_name'],
            rollupRate: $incomingRiderData['rollup_rate'],
            rollupPeriod: $incomingRiderData['rollup_period'] ?? '',
            fee: $incomingRiderData['fee'],
            isInbuilt: !$incomingRiderData['optional'],
            benefitBaseBonus: $incomingRiderData['bonus'] ?? 0,
            deferYears: $incomingRiderData['wait_period'] ?? 0,
            interestMultiplier: $incomingRiderData['interest_multiplier'] ?? null,
            hasIncreasingIncome: $incomingRiderData['increasing_income'],
            hasEnhancedPayments: $incomingRiderData['enhanced_payments'],
            unavailableInStates: $incomingRiderData['unavailable_in_states'],
            description: $incomingRiderData['description'] ?? '',
        );
    }

    public static function fake()
    {
        return new self(
            id: mt_rand(),
            name: '__RIDER_NAME__',
            type: '__RIDER_TYPE__',
            rollupRate: '__ROLLUP_RATE_',
            rollupPeriod: '__ROLLUP_PERIOD_',
            fee: '__FEE__',
            isInbuilt: false,
            benefitBaseBonus: 0,
            deferYears: 1,
            interestMultiplier: null,
            hasIncreasingIncome: false,
            hasEnhancedPayments: false,
            unavailableInStates: [],
            description: '__DESCRIPTION__'
        );
    }
}

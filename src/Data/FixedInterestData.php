<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

final class FixedInterestData
{
    public function __construct(
        public readonly int $id,
        public readonly int $guaranteedYears,
        public readonly array $surrenderSchedule,
        public readonly float $currentRate,
        public readonly float $minRate,
        public readonly ?float $premiumBonus,
        public readonly ?float $firstYearInterestBonus,
        public readonly array $stepRate,
        public readonly float $guaranteedYieldToSurrender,
        public readonly float $currentYieldToSurrender,
        public readonly array $availableStates,
        public readonly int $minPremium,
        public readonly int $maxPremium,
        public readonly bool $mva,
        public readonly bool $rop,
        public readonly int $productType,
    ) {}

    public static function parse(array $incomingInterestData)
    {
        return new self(
            id: $incomingInterestData['id'],
            guaranteedYears: $incomingInterestData['rate_term'],
            surrenderSchedule: $incomingInterestData['surrender_schedule'],
            currentRate: $incomingInterestData['actual_rate']['current_rate'],
            minRate: $incomingInterestData['actual_rate']['min_rate'] ?? 0.0,
            premiumBonus: $incomingInterestData['actual_rate']['premium_bonus'],
            firstYearInterestBonus: $incomingInterestData['actual_rate']['first_year_interest_bonus'],
            stepRate: $incomingInterestData['actual_rate']['step_rate'] ?? [],
            guaranteedYieldToSurrender: $incomingInterestData['actual_rate']['guaranteed_yield_to_surrender'],
            currentYieldToSurrender: $incomingInterestData['actual_rate']['current_yield_to_surrender'],
            availableStates: $incomingInterestData['available_in_states'],
            minPremium: $incomingInterestData['min_premium'],
            maxPremium: $incomingInterestData['max_premium'],
            mva: $incomingInterestData['mva'],
            rop: $incomingInterestData['rop'],
            productType: $incomingInterestData['product_type'],
        );
    }

    public function surrenderYears()
    {
        return count($this->surrenderSchedule);
    }

    public static function fake(array $override = [])
    {
        $params = [
            'id' => mt_rand(),
            'guaranteedYears' => 5,
            'surrenderSchedule' => [0.1, 0.9, 0.8, 0.7, 0.6],
            'currentRate' => 0.035,
            'minRate' => 0.01,
            'premiumBonus' => 0.1,
            'firstYearInterestBonus' => 0.01,
            'stepRate' => [],
            'guaranteedYieldToSurrender' => 0.035,
            'currentYieldToSurrender' => 0.025,
            'availableStates' => ['CO', 'CA'],
            'minPremium' => 1000,
            'maxPremium' => 1_000_000,
            'mva' => false,
            'rop' => true,
            'productType' => 1,
            ...$override,
        ];

        return new self(...$params);
    }
}

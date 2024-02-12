<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use Illuminate\Support\Collection;

final class FixedAnnuityData
{
    /**
     * @var \Illuminate\Support\Collection<int, FixedInterestData>
     */
    public Collection $interests;

    public function __construct(
        public readonly AnnuityInfo $annuityInfo,
        public readonly array $typesOfFunds,
        public readonly string $description,
        public readonly float $annualFreeWithdrawal,
        public readonly ?float $firstYearFreeWithdrawal,
        public readonly bool $interestOnlyWithdrawal,
        public readonly bool $simpleGrowth,
        public readonly string $premiumType,
    ) {
        $this->interests = collect();
    }

    public function withInterests(Collection $interests)
    {
        $this->interests = $interests;

        return $this;
    }

    public static function parse(array $incomingAnnuityData)
    {
        return new self(
            annuityInfo: new AnnuityInfo(
                id: $incomingAnnuityData['id'],
                name: $incomingAnnuityData['name'],
                brochureUrl: $incomingAnnuityData['brochure_url'],
                parentId: $incomingAnnuityData['parent_id'],
            ),
            typesOfFunds: $incomingAnnuityData['types_of_funds'],
            description: $incomingAnnuityData['description'] ?? '',
            annualFreeWithdrawal: $incomingAnnuityData['annual_free_withdrawal'] ?? 0.0,
            firstYearFreeWithdrawal: $incomingAnnuityData['first_year_free_withdrawal'],
            interestOnlyWithdrawal: $incomingAnnuityData['interest_only_withdrawal'],
            simpleGrowth: $incomingAnnuityData['simple_growth'],
            premiumType: $incomingAnnuityData['type_label'],
        );
    }

    public static function fake(array $override = [])
    {
        $params = [
            'annuityInfo' => AnnuityInfo::fake(),
            'typesOfFunds' => ['IRA', 'Non-qualified'],
            'description' => '__DESCRIPTION__',
            'annualFreeWithdrawal' => 0.1,
            'firstYearFreeWithdrawal' => 0,
            'interestOnlyWithdrawal' => false,
            'simpleGrowth' => false,
            'premiumType' => 'Single Premium',
            ...$override,
        ];

        return new self(...$params);
    }
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use AgathaGlobalTech\AnnuitiesGenius\FakeFactory;
use Illuminate\Support\Arr;

final class IndexedAnnuityData
{
    public function __construct(
        public readonly AnnuityInfo $annuityInfo,
        public readonly float $annualFreeWithdrawal,
        public readonly ?float $firstYearFreeWithdrawal,
        public readonly float $premiumBonus,
        public readonly array $bonusVestingSchedule,
        public readonly bool $marketValueAdjustments,
        public readonly bool $returnOfPremium,
        public readonly ?int $minimumContributionQualified,
        public readonly ?int $minimumContributionNonQualified,
        public readonly ?string $policyNotes,
        public readonly array $typesOfFunds,
        public readonly array $availableInStates,
        public readonly array $surrenderSchedule,
        public readonly bool $isStructured,
        public readonly ?int $flexPremiumsPermitted = null,
        public readonly ?string $launchDate = null,
        public readonly ?string $purposeText = null,
        public readonly ?int $annuitantAgeQualifiedMax = null,
        public readonly ?string $premiumNotes = null,
        public readonly ?string $withdrawalProvisions = null,
        public readonly ?array $waivers = null,
    ) {}

    public static function parse(array $incomingAnnuityData)
    {
        return new self(
            annuityInfo: new AnnuityInfo(
                id: $incomingAnnuityData['id'],
                name: $incomingAnnuityData['name'],
                brochureUrl: $incomingAnnuityData['brochure_url'],
                parentId: $incomingAnnuityData['parent_id'],
            ),
            annualFreeWithdrawal: $incomingAnnuityData['annual_free_withdrawal'],
            firstYearFreeWithdrawal: $incomingAnnuityData['first_year_free_withdrawal'],
            premiumBonus: $incomingAnnuityData['bonus'] ?? 0,
            bonusVestingSchedule: $incomingAnnuityData['bonus_vesting_schedule'] ?? [],
            marketValueAdjustments: (bool) ($incomingAnnuityData['mva'] ?? false),
            returnOfPremium: (bool) $incomingAnnuityData['rop'],
            minimumContributionQualified: $incomingAnnuityData['contribution_minimum_initial_qualified'],
            minimumContributionNonQualified: $incomingAnnuityData['contribution_minimum_initial_non_qualified'],
            policyNotes: $incomingAnnuityData['policy_notes'] ?? '',
            typesOfFunds: $incomingAnnuityData['types_of_funds'] ?? [],
            availableInStates: $incomingAnnuityData['available_in_states'] ?? [],
            surrenderSchedule: $incomingAnnuityData['surrender_schedule'] ?? [],
            isStructured: (bool) $incomingAnnuityData['is_structured'],
            flexPremiumsPermitted: $incomingAnnuityData['flex_premiums_permitted'] ?? null,
            launchDate: $incomingAnnuityData['launch_date'] ?? null,
            purposeText: $incomingAnnuityData['purpose_text'] ?? null,
            annuitantAgeQualifiedMax: $incomingAnnuityData['annuitant_age_qualified_max'] ?? null,
            premiumNotes: $incomingAnnuityData['premium_notes'] ?? null,
            withdrawalProvisions: $incomingAnnuityData['withdrawal_provisions'] ?? null,
            waivers: $incomingAnnuityData['waivers'] ?? null,
        );
    }

    public static function fake(array $override = [])
    {
        $params = [
            'annuityInfo' => AnnuityInfo::fake(),
            'annualFreeWithdrawal' => FakeFactory::randomFloat(0, 0.1),
            'firstYearFreeWithdrawal' => 0,
            'premiumBonus' => 0.1,
            'bonusVestingSchedule' => Arr::random([[], [0.1, 0.2]]),
            'marketValueAdjustments' => true,
            'returnOfPremium' => true,
            'minimumContributionQualified' => 10_000,
            'minimumContributionNonQualified' => 15_000,
            'policyNotes' => '__NOTES__',
            'typesOfFunds' => ['Non-qualified', 'IRA'],
            'availableInStates' => ['CA', 'CO'],
            'surrenderSchedule' => [0.1, 0.09, 0.08],
            'isStructured' => false,
            ...$override,
        ];

        return new self(...$params);
    }
}

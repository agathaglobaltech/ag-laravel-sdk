<?php

namespace AgathaGlobalTech\AnnuitiesGenius;

use AgathaGlobalTech\AnnuitiesGenius\Contracts\AnnuitiesGeniusApi;
use AgathaGlobalTech\AnnuitiesGenius\Data\AccountData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Backtest;
use AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\AccumulationData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\DeathBenefitRiderCalculation;
use AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\IncomeRiderCalculation;
use AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\MultiYearGuaranteedAnnuityCalculation;
use AgathaGlobalTech\AnnuitiesGenius\Data\CarrierData;
use AgathaGlobalTech\AnnuitiesGenius\Data\DeathBenefit;
use AgathaGlobalTech\AnnuitiesGenius\Data\DeckData;
use AgathaGlobalTech\AnnuitiesGenius\Data\FixedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\FixedInterestData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Income;
use AgathaGlobalTech\AnnuitiesGenius\Data\IndexedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Revenue;
use AgathaGlobalTech\AnnuitiesGenius\Data\RiderData;
use AgathaGlobalTech\AnnuitiesGenius\Data\UserInfo;
use AgathaGlobalTech\AnnuitiesGenius\Enums\AnnuityType;
use AgathaGlobalTech\AnnuitiesGenius\Params\AccumulationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\DeathBenefitRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\FixedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IncomeRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IndexedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\MultiYearGuaranteedAnnuitiesCalculationParams;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AnnuitiesGenius implements AnnuitiesGeniusApi
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $token
    ) {
    }

    private function client()
    {
        return Http::baseUrl($this->baseUrl)->withHeaders([
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ]);
    }

    public function me(): UserInfo
    {
        $me = $this
            ->client()
            ->post('me')
            ->throw()
            ->object();

        return new UserInfo(
            name: $me->name,
            email: $me->email,
        );
    }

    public function decks(): Collection
    {
        return $this
            ->client()
            ->get('decks')
            ->throw()
            ->collect()
            ->map(fn ($deck) => new DeckData(id: $deck->id, name: $deck->name));
    }

    public function calculateIncomeRiders(IncomeRiderCalculationParams $params): Collection
    {
        return $this
            ->client()
            ->post('guaranteed-rider-calculator', $params->toArray())
            ->throw()
            ->collect()
            ->map(function ($product) {
                return new IncomeRiderCalculation(
                    income: new Income(
                        guaranteedAnnualIncome: $product['income']['guaranteed'],
                        benefitBase: $product['income']['benefitBase'],
                        payoutRate: $product['income']['payoutRate'],
                    ),
                    rider: RiderData::parse($product['rider']),
                    annuity: IndexedAnnuityData::parse($product['options'][0]['annuity']),
                    carrier: CarrierData::parse($product['rider']['carrier'])
                );
            });
    }

    public function calculateDeathBenefitRiders(DeathBenefitRiderCalculationParams $params): Collection
    {
        return $this
            ->client()
            ->post('death-benefit-calculator', $params->toArray())
            ->throw()
            ->collect()
            ->map(function ($product) {
                return new DeathBenefitRiderCalculation(
                    deathBenefit: new DeathBenefit(
                        guaranteed: round($product['deathBenefit']['guaranteed'], 2),
                        hypothetical: round($product['deathBenefit']['hypothetical'], 2),
                    ),
                    rider: RiderData::parse($product['rider']),
                    annuity: IndexedAnnuityData::parse($product['options'][0]['annuity']),
                    carrier: CarrierData::parse($product['rider']['carrier'])
                );
            });
    }

    public function calculateAccumulation(AccumulationParams $params, int $page = 1): Collection
    {
        return $this
            ->client()
            ->post('growth-calculator', [...$params->toArray(), 'page' => $page])
            ->throw()
            ->collect('data')
            ->map(function ($product) {
                return new AccumulationData(
                    backtest: new Backtest(rateOfReturn: $product['backtest']['rate_of_return']),
                    account: AccountData::parse($product['account']),
                    annuity: IndexedAnnuityData::parse($product['annuity']),
                    carrier: CarrierData::parse($product['carrier'])
                );
            });
    }

    public function calculateMultiYearGuaranteedAnnuities(MultiYearGuaranteedAnnuitiesCalculationParams $params): Collection
    {
        return $this
            ->client()
            ->post('multi-year-calculator', [...$params->toArray()])
            ->throw()
            ->collect()
            ->map(function ($product) {
                return new MultiYearGuaranteedAnnuityCalculation(
                    revenue: new Revenue(
                        earnings: round($product['earnings'], 2),
                        endingValue: round($product['guaranteedEndingValue'], 2),
                    ),
                    annuity: FixedAnnuityData::parse($product['fixed_annuity']),
                    interest: FixedInterestData::parse($product),
                    carrier: CarrierData::parse($product['fixed_annuity']['carrier'])
                );
            });
    }

    public function carriers(): Collection
    {
        return $this
            ->client()
            ->get('carriers')
            ->throw()
            ->collect()
            ->map(fn ($carrier) => CarrierData::parse($carrier));
    }

    public function indexedAnnuities(IndexedAnnuitiesParams $params): Collection
    {
        $page = 1;
        $annuities = collect();

        do {
            $result = $this
                ->client()
                ->get('annuities/fixed-index', [...$params->toArray(), 'page' => $page])
                ->throw()
                ->json();

            foreach ($result['data'] as $annuity) {
                $annuities->push(IndexedAnnuityData::parse($annuity));
            }

            $page++;
        } while ($result['next_page_url']);

        return $annuities;
    }

    public function indexedAnnuityAccounts(int $annuityId): Collection
    {
        return $this
            ->client()
            ->get("annuities/fixed-index/$annuityId/accounts")
            ->throw()
            ->collect()
            ->map(fn ($accountData) => AccountData::parse($accountData));
    }

    public function riders(AnnuityType $annuityType, int $annuityId): Collection
    {
        $annuityPrefix = match ($annuityType) {
            AnnuityType::INDEXED_ANNUITY => 'fixed-index',
            AnnuityType::FIXED_ANNUITY => 'fixed',
            default => throw new \DomainException('This annuity type cannot have any riders.'),
        };

        return $this
            ->client()
            ->get("annuities/$annuityPrefix/$annuityId/riders")
            ->throw()
            ->collect()
            ->map(fn ($riderData) => RiderData::parse($riderData));
    }

    public function fixedAnnuities(FixedAnnuitiesParams $params): Collection
    {
        $page = 1;
        $annuities = collect();

        do {
            $result = $this
                ->client()
                ->get('annuities/fixed', [...$params->toArray(), 'page' => $page])
                ->throw()
                ->json();

            foreach ($result['data'] as $annuity) {
                $annuities->push(FixedAnnuityData::parse($annuity));
            }

            $page++;
        } while ($result['next_page_url']);

        return $annuities;
    }

    public function fixedAnnuityInterests(int $annuityId): Collection
    {
        return $this
            ->client()
            ->get("annuities/fixed/$annuityId/interests")
            ->throw()
            ->collect()
            ->map(fn ($interest) => FixedInterestData::parse($interest));
    }
}

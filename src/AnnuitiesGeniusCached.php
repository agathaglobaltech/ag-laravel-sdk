<?php

namespace AgathaGlobalTech\AnnuitiesGenius;

use AgathaGlobalTech\AnnuitiesGenius\Contracts\AnnuitiesGeniusApi;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use AgathaGlobalTech\AnnuitiesGenius\Data\UserInfo;
use AgathaGlobalTech\AnnuitiesGenius\Enums\AnnuityType;
use AgathaGlobalTech\AnnuitiesGenius\Params\AccumulationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\BestAnnuitiesChartsParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\DeathBenefitRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\FixedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IncomeRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IndexedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\MultiYearGuaranteedAnnuitiesCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\Params;
use Illuminate\Support\Collection;

class AnnuitiesGeniusCached implements AnnuitiesGeniusApi
{
    public function __construct(
        protected AnnuitiesGenius $annuitiesGeniusApi,
        protected int $cacheForHours = 24,
    ) {}

    private function cached(string $method, array $args = [], ?CacheableParams $params = null)
    {
        $key = $params ? "${method}-{$params->uniqueKey()}" : "genius-api-${method}";

        return cache()->remember(
            key: $key,
            ttl: now()->addHours($this->cacheForHours),
            callback: fn () => $this->annuitiesGeniusApi->{$method}(...$args)
        );
    }

    public function me(): UserInfo
    {
        return $this->annuitiesGeniusApi->me();
    }

    public function decks(): Collection
    {
        return $this->annuitiesGeniusApi->decks();
    }

    public function calculateIncomeRiders(IncomeRiderCalculationParams $params): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }

    public function calculateDeathBenefitRiders(DeathBenefitRiderCalculationParams $params): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }

    public function calculateAccumulation(AccumulationParams $params, int $page = 1): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }

    public function carriers(): Collection
    {
        return $this->cached(__FUNCTION__);
    }

    public function indexedAnnuities(IndexedAnnuitiesParams $params): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }

    public function calculateMultiYearGuaranteedAnnuities(MultiYearGuaranteedAnnuitiesCalculationParams $params): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }

    public function indexedAnnuityAccounts(int $annuityId): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), new Params([$annuityId]));
    }

    public function riders(AnnuityType $annuityType, int $annuityId): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), new Params([$annuityId, $annuityType]));
    }

    public function fixedAnnuities(FixedAnnuitiesParams $params): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }

    public function fixedAnnuityInterests(int $annuityId): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), new Params([$annuityId]));
    }

    public function bestAnnuitiesCharts(BestAnnuitiesChartsParams $params): Collection
    {
        return $this->cached(__FUNCTION__, func_get_args(), $params);
    }
}

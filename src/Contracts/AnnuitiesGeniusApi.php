<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Contracts;

use AgathaGlobalTech\AnnuitiesGenius\Params\AccumulationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\DeathBenefitRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\FixedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IncomeRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IndexedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\MultiYearGuaranteedAnnuitiesCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Enums\AnnuityType;
use Illuminate\Support\Collection;

interface AnnuitiesGeniusApi
{
    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\IncomeRiderCalculation, int>
     */
    public function calculateIncomeRiders(IncomeRiderCalculationParams $params): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\DeathBenefitRiderCalculation, int>
     */
    public function calculateDeathBenefitRiders(DeathBenefitRiderCalculationParams $params): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\AccumulationData, int>
     */
    public function calculateAccumulation(AccumulationParams $params, int $page = 1): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\Calculations\MultiYearGuaranteedAnnuityCalculation, int>
     */
    public function calculateMultiYearGuaranteedAnnuities(MultiYearGuaranteedAnnuitiesCalculationParams $params): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\CarrierData, int>
     */
    public function carriers(): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\IndexedAnnuityData, int>
     */
    public function indexedAnnuities(IndexedAnnuitiesParams $params): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\AccountData, int>
     */
    public function indexedAnnuityAccounts(int $annuityId): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\RiderData, int>
     */
    public function riders(AnnuityType $annuityType, int $annuityId): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\FixedAnnuityData, int>
     */
    public function fixedAnnuities(FixedAnnuitiesParams $params): Collection;

    /**
     * @returns Collection<\AgathaGlobalTech\AnnuitiesGenius\Data\FixedInterestData, int>
     */
    public function fixedAnnuityInterests(int $annuityId): Collection;
}

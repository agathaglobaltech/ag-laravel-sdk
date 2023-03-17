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
use AgathaGlobalTech\AnnuitiesGenius\Data\FixedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\FixedInterestData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Income;
use AgathaGlobalTech\AnnuitiesGenius\Data\IndexedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Revenue;
use AgathaGlobalTech\AnnuitiesGenius\Data\RiderData;
use AgathaGlobalTech\AnnuitiesGenius\Enums\AnnuityType;
use AgathaGlobalTech\AnnuitiesGenius\Params\AccumulationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\DeathBenefitRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\FixedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IncomeRiderCalculationParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\IndexedAnnuitiesParams;
use AgathaGlobalTech\AnnuitiesGenius\Params\MultiYearGuaranteedAnnuitiesCalculationParams;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AnnuitiesGeniusFactory
{
    public function make(string $baseUrl, string $token, ?int $cacheForHours = null): AnnuitiesGeniusApi
    {
        $genius = new AnnuitiesGenius($baseUrl, $token);

        if ($cacheForHours) {
            return new AnnuitiesGeniusCached($genius, $cacheForHours);
        }

        return $genius;
    }
}

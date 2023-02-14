<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data\Calculations;

use AgathaGlobalTech\AnnuitiesGenius\Data\CarrierData;
use AgathaGlobalTech\AnnuitiesGenius\Data\FixedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\FixedInterestData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Revenue;

class MultiYearGuaranteedAnnuityCalculation
{
    public function __construct(
        public readonly Revenue $revenue,
        public readonly FixedAnnuityData $annuity,
        public readonly FixedInterestData $interest,
        public readonly CarrierData $carrier,
    )
    {
    }

    public static function fake(): self
    {
        return new self(
            revenue: Revenue::fake(),
            annuity: FixedAnnuityData::fake(),
            interest: FixedInterestData::fake(),
            carrier: CarrierData::fake(),
        );
    }
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data\Calculations;

use AgathaGlobalTech\AnnuitiesGenius\Data\CarrierData;
use AgathaGlobalTech\AnnuitiesGenius\Data\DeathBenefit;
use AgathaGlobalTech\AnnuitiesGenius\Data\IndexedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\RiderData;

class DeathBenefitRiderCalculation
{
    public function __construct(
        public readonly DeathBenefit $deathBenefit,
        public readonly RiderData $rider,
        public readonly IndexedAnnuityData $annuity,
        public readonly CarrierData $carrier,
    ) {
    }

    public static function fake(): self
    {
        return new self(
            deathBenefit: DeathBenefit::fake(),
            rider: RiderData::fake(),
            annuity: IndexedAnnuityData::fake(),
            carrier: CarrierData::fake(),
        );
    }
}

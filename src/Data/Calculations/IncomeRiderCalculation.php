<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data\Calculations;

use AgathaGlobalTech\AnnuitiesGenius\Data\CarrierData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Income;
use AgathaGlobalTech\AnnuitiesGenius\Data\IndexedAnnuityData;
use AgathaGlobalTech\AnnuitiesGenius\Data\RiderData;

class IncomeRiderCalculation
{
    public function __construct(
        public readonly Income $income,
        public readonly RiderData $rider,
        public readonly IndexedAnnuityData $annuity,
        public readonly CarrierData $carrier,
    ) {
    }

    public static function fake(): self
    {
        return new self(
            income: Income::fake(),
            rider: RiderData::fake(),
            annuity: IndexedAnnuityData::fake(),
            carrier: CarrierData::fake(),
        );
    }
}

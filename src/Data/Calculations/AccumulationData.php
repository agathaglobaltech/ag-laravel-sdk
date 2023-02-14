<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data\Calculations;

use AgathaGlobalTech\AnnuitiesGenius\Data\AccountData;
use AgathaGlobalTech\AnnuitiesGenius\Data\Backtest;
use AgathaGlobalTech\AnnuitiesGenius\Data\CarrierData;
use AgathaGlobalTech\AnnuitiesGenius\Data\IndexedAnnuityData;

class AccumulationData
{
    public function __construct(
        public readonly Backtest $backtest,
        public readonly AccountData $account,
        public readonly IndexedAnnuityData $annuity,
        public readonly CarrierData $carrier,
    ) {
    }
}

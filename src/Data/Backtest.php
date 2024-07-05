<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

class Backtest
{
    public function __construct(
        public readonly float $rateOfReturn,
    ) {}
}

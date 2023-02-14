<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use AgathaGlobalTech\AnnuitiesGenius\Enums\FundsType;
use AgathaGlobalTech\AnnuitiesGenius\Enums\Gender;
use Illuminate\Contracts\Support\Arrayable;

class IncomeRiderCalculationParams implements CacheableParams, Arrayable
{
    use WithUniqueKey;

    public function __construct(
        public readonly int $age,
        public readonly string $state,
        public readonly Gender $gender,
        public readonly int $premium,
        public readonly FundsType $fundsType,
        public readonly int $incomeStartAge,
        public readonly ?int $jointAge = null,
        public readonly ?int $limit = null,
        public readonly string $strategy = 'no-decrease',
    ) {
    }

    public function toArray()
    {
        return array_filter([
            'state' => $this->state,
            'age' => $this->age,
            'gender' => $this->gender->value,
            'payoutType' => $this->payoutType(),
            'premium' => $this->premium,
            'lifetimeIncomeStartAge' => $this->incomeStartAge,
            'solveFor' => 'income',
            'level_of_detail' => 'top-for-carrier',
            'jointAge' => $this->jointAge,
            'strategy' => $this->strategy,
            'limit' => $this->limit,
        ]);
    }

    private function payoutType(): string
    {
        if ($this->jointAge) {
            return 'joint';
        }

        return $this->gender->value;
    }
}

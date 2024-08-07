<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use AgathaGlobalTech\AnnuitiesGenius\Enums\FundsType;
use AgathaGlobalTech\AnnuitiesGenius\Enums\Gender;
use Illuminate\Contracts\Support\Arrayable;

class IncomeRiderCalculationParams implements Arrayable, CacheableParams
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
        public readonly ?int $deckId = null,
        public readonly string $strategy = 'no-decrease',
        public readonly string $levelOfDetail = 'top-for-carrier',
    ) {}

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
            'level_of_detail' => $this->levelOfDetail,
            'jointAge' => $this->jointAge,
            'strategy' => $this->strategy,
            'limit' => $this->limit,
            'deck_id' => $this->deckId,
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

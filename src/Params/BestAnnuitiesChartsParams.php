<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use AgathaGlobalTech\AnnuitiesGenius\Enums\Gender;
use Illuminate\Contracts\Support\Arrayable;

class BestAnnuitiesChartsParams implements Arrayable, CacheableParams
{
    use WithUniqueKey;

    public function __construct(
        private readonly int $age,
        private readonly int $premium,
        private readonly string $state,
        private readonly Gender $gender,
        private readonly int $lifetimeIncomeStartAge,
        private readonly ?int $jointAge,
    ) {}

    public function toArray()
    {
        return [
            'age' => $this->age,
            'premium' => $this->premium,
            'state' => $this->state,
            'gender' => $this->gender->value,
            'lifetimeIncomeStartAge' => $this->lifetimeIncomeStartAge,
            'payoutType' => $this->payoutType(),
            'jointAge' => $this->jointAge,
        ];
    }

    private function payoutType(): string
    {
        if ($this->jointAge) {
            return 'joint';
        }

        return $this->gender->value;
    }
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use Illuminate\Contracts\Support\Arrayable;

class MultiYearGuaranteedAnnuitiesCalculationParams implements CacheableParams, Arrayable
{
    use WithUniqueKey;

    public function __construct(
        public readonly int $age,
        public readonly int $premium,
        public readonly string $state,
        public readonly array $guaranteedYears,
    ) {
    }

    public function toArray()
    {
        return [
            'age' => $this->age,
            'premium' => $this->premium,
            'state' => $this->state,
            'selected_guaranteed_years' => $this->guaranteedYears,
        ];
    }
}

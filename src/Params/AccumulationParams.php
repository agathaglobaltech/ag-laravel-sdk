<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use Illuminate\Contracts\Support\Arrayable;

class AccumulationParams implements CacheableParams, Arrayable
{
    use WithUniqueKey;

    public function __construct(
        public readonly int $premium,
        public readonly int $age,
        public readonly string $state,
    ) {
    }

    public function toArray()
    {
        return [
            'premium' => $this->premium,
            'age' => $this->age,
            'state' => $this->state,
            'sort_mode' => 'compliant',
            'type' => 'indexed',
            'actual_index_age' => 10,
            'max_participation_rate' => 1,
            'no_fee' => 1,
            'top_per_carrier' => 1,
        ];
    }
}

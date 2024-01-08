<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use Illuminate\Contracts\Support\Arrayable;

class FixedAnnuitiesParams implements Arrayable, CacheableParams
{
    use WithUniqueKey;

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?int $carrierId = null,
    ) {
    }

    public function toArray()
    {
        return [
            'filter' => [
                'name' => $this->name,
                'carrier_id' => $this->carrierId,
            ],
        ];
    }
}

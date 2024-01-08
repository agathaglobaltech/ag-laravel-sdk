<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use Illuminate\Contracts\Support\Arrayable;

class IndexedAnnuitiesParams implements Arrayable, CacheableParams
{
    use WithUniqueKey;

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?int $carrierId = null,
        public readonly bool $structured = false,
    ) {
    }

    public function toArray()
    {
        return [
            'filter' => [
                'name' => $this->name,
                'carrier_id' => $this->carrierId,
                'is_structured' => $this->structured ? 1 : 0,
            ],
        ];
    }
}

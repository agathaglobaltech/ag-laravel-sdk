<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use Illuminate\Contracts\Support\Arrayable;

class Params implements CacheableParams
{
    use WithUniqueKey;

    public function __construct(
        protected readonly array $params
    ) {
    }
}

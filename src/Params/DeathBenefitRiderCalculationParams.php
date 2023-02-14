<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use AgathaGlobalTech\AnnuitiesGenius\Enums\DeathBenefitType;

class DeathBenefitRiderCalculationParams implements CacheableParams
{
    use WithUniqueKey;

    public function __construct(
        private readonly int $age,
        private readonly int $lifeExpectancy,
        private readonly int $premium,
        private readonly string $state,
        private readonly DeathBenefitType $deathBenefitType,
        private readonly ?int $limit = null,
    ) {
    }

    public function toArray()
    {
        return [
            'age' => $this->age,
            'life_expectancy' => $this->lifeExpectancy,
            'premium' => $this->premium,
            'state' => $this->state,
            'death_benefit_type_id' => $this->deathBenefitType->value,
            'limit' => $this->limit,
            'level_of_detail' => 'top-for-carrier',
        ];
    }
}

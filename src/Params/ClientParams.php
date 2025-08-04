<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Params;

use AgathaGlobalTech\AnnuitiesGenius\Concerns\WithUniqueKey;
use AgathaGlobalTech\AnnuitiesGenius\Contracts\CacheableParams;
use AgathaGlobalTech\AnnuitiesGenius\Enums\Gender;
use App\Enums\ClientSourceEnum;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

class ClientParams implements Arrayable, CacheableParams
{
    use WithUniqueKey;

    public function __construct(
        public readonly string $name,
        public readonly ClientSourceEnum $source,
        public readonly string $state,
        public readonly int $age,
        public readonly ?int $initialInvestment = null,
        public readonly ?string $primaryPhone = null,
        public readonly ?string $email = null,
        public readonly ?Gender $gender = null,
        public readonly ?Carbon $dateOfBirth = null,
        public readonly ?Carbon $validatedPhoneAt = null,
        public readonly ?int $startIncomeAtAge = null,
        public readonly ?string $spouseName = null,
        public readonly ?Carbon $spouseDateOfBirth = null,
        public readonly ?int $spouseAge = null,
        public readonly ?string $notes = null,
    ) {}

    public function toArray()
    {
        return [
            'name' => $this->name,
            'state' => $this->state,
            'initial_investment' => $this->initialInvestment,
            'primary_phone' => $this->primaryPhone,
            'email' => $this->email,
            'gender' => $this->gender?->value,
            'date_of_birth' => $this->dateOfBirth?->toDateString(),
            'age' => $this->age,
            'validated_phone_at' => $this->validatedPhoneAt?->toDateTimeString(),
            'start_income_at_age' => $this->startIncomeAtAge,
            'source' => $this->source->value,
            'spouse_name' => $this->spouseName,
            'spouse_date_of_birth' => $this->spouseDateOfBirth?->toDateString(),
            'spouse_age' => $this->spouseAge,
            'notes' => $this->notes,
        ];
    }
}

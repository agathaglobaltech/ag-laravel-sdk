<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use Illuminate\Support\Arr;

class AnnuityInfo
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $brochureUrl,
        public readonly ?int $parentId = null,
    ) {}

    public static function fake(array $override = [])
    {
        $params = [
            'id' => mt_rand(),
            'name' => '__ANNUITY_NAME__',
            'brochureUrl' => Arr::random([null, '/brochure.pdf']),
            ...$override,
        ];

        return new self(...$params);
    }
}

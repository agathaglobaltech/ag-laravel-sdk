<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use AgathaGlobalTech\AnnuitiesGenius\FakeFactory;
use Illuminate\Support\Str;

class DeckData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function fake(array $override = [])
    {
        $params = [
            'id' => FakeFactory::randomFloat(1, 10_000),
            'name' => Str::random(10),
            ...$override,
        ];

        return new self(...$params);
    }
}

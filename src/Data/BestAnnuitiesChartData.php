<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use AgathaGlobalTech\AnnuitiesGenius\FakeFactory;
use Illuminate\Support\Arr;

final class BestAnnuitiesChartData
{
    public function __construct(
        public readonly string $name,
        public readonly float|int $value,
        public readonly array $chart,
    ) {}

    public static function parse(string $name, array $data): self
    {
        return new self(
            name: $name,
            value: $data['value'],
            chart: $data['chart'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'chart' => $this->chart,
        ];
    }

    public static function fake(array $override = []): self
    {
        $chartNames = [
            'guaranteed-lifetime-income',
            'market-linked-growth',
            'fixed-interest-rate',
        ];

        $default = [
            'name' => FakeFactory::randomElement($chartNames),
            'value' => FakeFactory::randomFloat(2, 5000, 20000),
            'chart' => [
                'labels' => range(1, 10),
                'data' => array_map(
                    fn($i) => round(10000 + $i * FakeFactory::randomFloat(2, 50, 300), 2),
                    range(1, 10)
                ),
            ],
        ];

        return new self(...array_replace_recursive($default, $override));
    }
}

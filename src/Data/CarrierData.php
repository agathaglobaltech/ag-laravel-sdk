<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use Illuminate\Support\Arr;

final class CarrierData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $shortName,
        public readonly ?string $logoUrl,
        public readonly ?int $foundationYear,
        public readonly ?string $ratingAmBest = null,
        public readonly ?string $ratingStandardAndPoors = null,
        public readonly ?string $ratingFitch = null,
        public readonly ?string $ratingMoodys = null,
        public readonly ?string $ratingComdex = null,
        public readonly ?string $logoBigUrl = null,
        public readonly ?bool $published = null,
    ) {
    }

    public static function parse(array $incomingCarrierData)
    {
        return new self(
            id: $incomingCarrierData['id'],
            name: $incomingCarrierData['name'],
            shortName: $incomingCarrierData['shortest_name'],
            logoUrl: $incomingCarrierData['logo_url'],
            foundationYear: $incomingCarrierData['foundation_year'],
            ratingAmBest: $incomingCarrierData['rating_ambest_label'],
            ratingStandardAndPoors: $incomingCarrierData['rating_standard_poors_label'],
            ratingFitch: $incomingCarrierData['rating_fitch_label'],
            ratingMoodys: $incomingCarrierData['rating_moodys_label'],
            ratingComdex: $incomingCarrierData['rating_comdex'],
            logoBigUrl: $incomingCarrierData['logo_big_url'],
            published: $incomingCarrierData['published'],
        );
    }

    public static function fake(array $override = [])
    {
        $params = [
            'id' => mt_rand(),
            'name' => '__CARRIER_NAME__',
            'shortName' => '__CR._NAME__',
            'logoUrl' => Arr::random([null, '/logo.png']),
            'logoBigUrl' => Arr::random([null, '/logo.png']),
            'foundationYear' => Arr::random([null, random_int(1950, 2000)]),
            'ratingAmBest' => Arr::random([null, 'A++', 'B--', 'C']),
            'ratingStandardAndPoors' => Arr::random([null, 'A++', 'B--', 'C']),
            ...$override,
        ];

        return new self(...$params);
    }
}

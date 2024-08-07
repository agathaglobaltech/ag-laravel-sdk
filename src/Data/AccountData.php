<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

class AccountData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $type,
        public readonly ?string $indexName,
        public readonly ?float $fixedRate,
        public readonly ?float $participationRate,
        public readonly ?float $cap,
        public readonly ?float $spread,
        public readonly ?float $performanceTriggered,
        public readonly ?string $averaging,
        public readonly ?string $reset,
        public readonly ?float $minPremium,
        public readonly ?float $maxPremium,
        public readonly ?float $floor = null,
        public readonly ?float $buffer = null,
        public readonly ?float $downsideParticipationRate = null,
        public readonly ?float $fee = null,
    ) {}

    public static function parse(array $accountData)
    {
        return new self(
            id: $accountData['id'],
            name: $accountData['name'],
            type: $accountData['type_label'],
            indexName: $accountData['index']['name'] ?? null,
            fixedRate: $accountData['actual_rate']['fixed_rate'] ?? null,
            participationRate: $accountData['actual_rate']['participation_rate'] ?? null,
            cap: $accountData['actual_rate']['cap'] ?? null,
            spread: $accountData['actual_rate']['spread'] ?? null,
            performanceTriggered: $accountData['actual_rate']['performance_triggered'] ?? null,
            averaging: $accountData['averaging_label'] ?: null,
            reset: $accountData['reset_label'] ?: null,
            minPremium: $accountData['min_premium'] ?: null,
            maxPremium: $accountData['max_premium'] ?: null,
            floor: $accountData['floor'] ?? null,
            buffer: $accountData['buffer'] ?? null,
            downsideParticipationRate: $accountData['downside_participation_rate'] ?? null,
            fee: $accountData['fee'] ?? null,
        );
    }
}

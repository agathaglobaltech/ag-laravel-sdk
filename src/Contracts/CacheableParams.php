<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Contracts;

interface CacheableParams
{
    public function uniqueKey(): string;
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius;

use AgathaGlobalTech\AnnuitiesGenius\Contracts\AnnuitiesGeniusApi;

class AnnuitiesGeniusFactory
{
    public function make(string $baseUrl, string $token, ?int $cacheForHours = null): AnnuitiesGeniusApi
    {
        $genius = new AnnuitiesGenius($baseUrl, $token);

        if ($cacheForHours) {
            return new AnnuitiesGeniusCached($genius, $cacheForHours);
        }

        return $genius;
    }
}

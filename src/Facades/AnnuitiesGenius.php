<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Facades;

use AgathaGlobalTech\AnnuitiesGenius\Contracts\AnnuitiesGeniusApi;
use Illuminate\Support\Facades\Facade;

/**
 * @see \AgathaGlobalTech\AnnuitiesGenius\Contracts\AnnuitiesGeniusApi
 */
class AnnuitiesGenius extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AnnuitiesGeniusApi::class;
    }
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AgathaGlobalTech\AnnuitiesGenius\AnnuitiesGenius
 */
class AnnuitiesGenius extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AgathaGlobalTech\AnnuitiesGenius\AnnuitiesGenius::class;
    }
}

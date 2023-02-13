<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Commands;

use Illuminate\Console\Command;

class AnnuitiesGeniusCommand extends Command
{
    public $signature = 'ag-laravel-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Concerns;

trait WithUniqueKey
{
    public function uniqueKey(): string
    {
        return class_basename($this).'-'.md5(serialize($this));
    }
}

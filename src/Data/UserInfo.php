<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

use AgathaGlobalTech\AnnuitiesGenius\FakeFactory;

class UserInfo
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {
    }
}

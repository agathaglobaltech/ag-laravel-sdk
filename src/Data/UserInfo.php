<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Data;

class UserInfo
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}

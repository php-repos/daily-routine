<?php

namespace PhpRepos\DailyRoutines\Kernel\IO\Response;

class Header
{
    public function __construct(
        public readonly Status $status,
        public readonly string $content_type,
    ) {}
}

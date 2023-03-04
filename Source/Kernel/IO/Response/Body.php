<?php

namespace PhpRepos\DailyRoutines\Kernel\IO\Response;

class Body
{
    public function __construct(public readonly string $content) {}
}

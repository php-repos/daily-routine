<?php

namespace PhpRepos\DailyRoutines\Kernel\Drivers\System\OS;

function is_linux(): bool
{
    return str_starts_with(name(), 'Linux');
}

function is_mac(): bool
{
    return str_starts_with(name(), 'Darwin');
}

function name(): string
{
    return PHP_OS;
}

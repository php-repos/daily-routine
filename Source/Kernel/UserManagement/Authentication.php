<?php

namespace PhpRepos\DailyRoutines\Kernel\UserManagement\Authentication;

function system_user(): string
{
    return trim(shell_exec('whoami'));
}

<?php

namespace Tests\RamStatusTest;

use function PhpRepos\DailyRoutines\Kernel\Drivers\System\RamStatus\get;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return ram status',
    case: function () {
        var_dump(get());
    }
);

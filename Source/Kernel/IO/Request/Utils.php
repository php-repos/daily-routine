<?php

namespace PhpRepos\DailyRoutines\Kernel\IO\Request\Utils;

use PhpRepos\DailyRoutines\Kernel\IO\Request\Request;

function parse_http(): Request
{
    return new Request($_SERVER['REQUEST_URI'], $_GET);
}

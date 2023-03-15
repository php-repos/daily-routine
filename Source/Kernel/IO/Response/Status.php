<?php

namespace PhpRepos\DailyRoutines\Kernel\IO\Response;

enum Status: int
{
    case OK = 200;
    case NOT_FOUND = 404;
}

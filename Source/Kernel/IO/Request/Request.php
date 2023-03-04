<?php

namespace PhpRepos\DailyRoutines\Kernel\IO\Request;

use function PhpRepos\Datatype\Str\before_first_occurrence;

class Request
{
    public function __construct(
        public readonly string $url,
        public readonly array $params,
    ) {}

    public function base_url(): string
    {
        return before_first_occurrence($this->url, '?');
    }
}

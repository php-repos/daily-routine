<?php

namespace PhpRepos\DailyRoutines\Kernel\IO\Response;

class Response
{
    public function __construct(
        public readonly Header $header,
        public readonly Body $body,
    ) {}

    public static function html(string $html, ?Status $status = null): static
    {
        $header = new Header(
            $status ?? Status::OK,
            'text/html; charset=UTF-8',
        );

        $body = new Body($html);

        return new self($header, $body);
    }

    public static function json(array $data, ?Status $status = null): static
    {
        $header = new Header(
            $status ?? Status::OK,
            'application/json; charset=UTF-8',
        );

        $body = new Body(json_encode($data));

        return new self($header, $body);
    }
}

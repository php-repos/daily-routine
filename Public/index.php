<?php

use PhpRepos\DailyRoutines\Kernel\Bootstrap;
use PhpRepos\DailyRoutines\Kernel\IO\Request\Utils;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Response;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Status;
use PhpRepos\DailyRoutines\Kernel\Router;
use PhpRepos\DailyRoutines\Kernel\UI\Html;


error_log('request received');
error_log('Booting application');
$application = Bootstrap\boot();
error_log('create request');
$request = Utils\parse_http();

error_log('find route');
$endpoint = Router\http($request, $application->routes);
error_log('check endpoint');
$response = is_callable($endpoint)
    ? call_user_func($endpoint, $request)
    : Response::html(Html\view('404'), status: Status::NOT_FOUND);

error_log('send response header');
http_response_code($response->header->status->value);
header('Content-Type: ' . $response->header->content_type);
error_log('send response body');
echo $response->body->content;
error_log('response sent');

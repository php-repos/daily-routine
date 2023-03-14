<?php

use PhpRepos\DailyRoutines\Kernel\Bootstrap;
use PhpRepos\DailyRoutines\Kernel\IO\Request\Utils;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Response;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Status;
use PhpRepos\DailyRoutines\Kernel\Router;
use PhpRepos\DailyRoutines\Kernel\UI\Html;


error_log('request received', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
error_log('Booting application', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
$application = Bootstrap\boot();
error_log('create request', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
$request = Utils\parse_http();

error_log('find route', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
$endpoint = Router\http($request, $application->routes);
error_log('check endpoint', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
$response = is_callable($endpoint)
    ? call_user_func($endpoint, $request)
    : Response::html(Html\view('404'), status: Status::NOT_FOUND);

error_log('send response header', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
http_response_code($response->header->status->value);
header('Content-Type: ' . $response->header->content_type);
error_log('send response body', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
echo $response->body->content;
error_log('response sent', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');

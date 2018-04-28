<?php

use Symfony\Component\HttpKernel\Exception as SymfonyException;
use Iphuongtt\Heimdal\Formatters;

return [
    'add_cors_headers' => false,

    // Has to be in prioritized order, e.g. highest priority first.
    'formatters' => [
        SymfonyException\UnprocessableEntityHttpException::class => Formatters\UnprocessableEntityHttpExceptionFormatter::class,
        SymfonyException\HttpException::class => Formatters\HttpExceptionFormatter::class,
        Exception::class => Formatters\ExceptionFormatter::class,
    ],

    'response_factory' => \Iphuongtt\Heimdal\ResponseFactory::class,

    'reporters' => [
        /*'sentry' => [
            'class'  => \Iphuongtt\Heimdal\Reporters\SentryReporter::class,
            'config' => [
                'dsn' => '',
                // For extra options see https://docs.sentry.io/clients/php/config/
                // php version and environment are automatically added.
                'sentry_options' => []
            ]
        ]*/
    ],

    'server_error_production' => 'An error occurred.'
];

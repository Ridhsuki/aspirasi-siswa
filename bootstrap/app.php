<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Fahlisaputra\Minify\Middleware\MinifyHtml;
use Fahlisaputra\Minify\Middleware\MinifyCss;
use Fahlisaputra\Minify\Middleware\MinifyJavascript;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EnsureUserRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            MinifyHtml::class,
            MinifyCss::class,
            MinifyJavascript::class,
        ]);

        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'user' => EnsureUserRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

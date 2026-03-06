<?php

use App\Http\Middleware\CheckUserRole;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        // commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'IsAdmin' => CheckUserRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Throwable $e, Request $request) {

            if ($request->is('api/*')) {

                if ($e instanceof ValidationException) {
                    return response()->json([
                        'message' => 'Validation failed.',
                        'errors' => $e->errors(),
                    ], 422);
                }

                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'message' => 'Not found.',
                    ], 404);
                }

                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthorized.',
                    ], 401);
                }

                return response()->json([
                    'message' => 'Something went wrong.',
                ], 500);
            }
        });

    })->create();

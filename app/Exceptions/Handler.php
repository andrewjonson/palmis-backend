<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'type' => 2,
                'message' => $exception->errors()
            ], $exception->status);
        } elseif ($exception instanceof AuthorizationException ||
                    $exception instanceof Spatie\Permission\Exceptions\UnauthorizedException
        ) {
            return response()->json([
                'type' => 2,
                'message' => 'This action is forbidden'
            ], 403);
        } elseif ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'type' => 2,
                'message' => 'Page not found'
            ], 404);
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'type' => 2,
                'message' => 'Method not allowed'
            ], 405);
        } elseif ($exception instanceof AuthenticationException ||
                    $exception instanceof Illuminate\Validation\UnauthorizedException
        ) {
            return response()->json([
                'type' => 2,
                'message' => 'Unauthenticated'
            ], 401);
        } elseif ($exception instanceof BadRequestException) {
            return response()->json([
                'type' => 2,
                'message' => 'Bad Request'
            ], 400);
        }

        return parent::render($request, $exception);
    }
}

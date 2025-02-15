<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (AuthenticationException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], Response::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        });

        $this->renderable(function (AccessDeniedHttpException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], Response::HTTP_FORBIDDEN);
        });

        $this->renderable(function (ValidationException $e) {
            throw new MyValidationException($e);
        });
    }
}

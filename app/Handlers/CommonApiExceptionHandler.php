<?php

namespace App\Handlers;

use App\Http\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Configuration\Exceptions;

class CommonApiExceptionHandler
{
    use ApiResponse;

    public function handler(Exceptions $exceptions): void
    {

        // Handle ModelNotFoundException (e.g., when a model is not found)
        $exceptions->renderable(function (ModelNotFoundException $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->error($e->getMessage(), self::$responseCode::HTTP_NOT_FOUND);
            }
        });

        // Handle AuthenticationException (e.g., when a user is not authenticated)
        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->error($e->getMessage(), self::$responseCode::HTTP_UNAUTHORIZED);
            }
        });

        // Handle AuthorizationException (e.g., when a user lacks the required permissions)
        $exceptions->renderable(function (AuthorizationException $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->error($e->getMessage(), self::$responseCode::HTTP_FORBIDDEN);
            }
        });

        // Handle ValidationException (e.g., when form validation fails)
        $exceptions->renderable(function (ValidationException $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->error($e->getMessage(), self::$responseCode::HTTP_UNPROCESSABLE_ENTITY, $e->errors());
            }
        });

        // Handle NotFoundHttpException (e.g., when a route is not found)
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->error($e->getMessage(), self::$responseCode::HTTP_NOT_FOUND);
            }
        });

        // Handle generic HttpException
        $exceptions->renderable(function (HttpException $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->error($e->getMessage(), $e->getStatusCode());
            }
        });
    }
}

<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [//
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = ['current_password', 'password', 'password_confirmation',];

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
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $exception = $this->prepareException($exception);

            if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
                return $exception->getResponse();
            }
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->unauthenticated($request, $exception);
            }
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return $this->convertValidationExceptionToResponse($exception, $request);
            }

            $response = [];

            $statusCode = 500;
            if (method_exists($exception, 'getStatusCode')) {
                $statusCode = $exception->getStatusCode();
            }

            switch ($statusCode) {
                case 404:
                    $response['message'] = 'Record not nound';
                    break;

                case 403:
                    $response['message'] = 'Forbidden';
                    break;

                default:
                    $response['message'] = $exception->getMessage();
                    break;
            }

            if (config('app.debug')) {
                $response['trace'] = $exception->getTrace();
                $response['code'] = $exception->getCode();
            }

            return response()->json($response, $statusCode);
        }
        return parent::render($request, $exception);
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e) {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e) {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if ($e instanceof HttpException) {

            $statusCode = $e->getStatusCode();

            if ($statusCode == 404 || $statusCode == 405) {
                return response()->json([ 'errors' => ['error_type' => 'Unknown', 'message' => 'Not Found'], 'code' => 404, 'message' => 'Not Found']);
            } else
            if ($statusCode == 400) {
                return response()->json([ 'errors' => ['error_type' => 'Unknown', 'message' => 'Invalid Parameter'], 'code' => 400, 'message' => 'Invalid Parameter']);
            } else {
                return response()->json([ 'errors' => ['error_type' => 'Unknown', 'message' => ''], 'code' => $statusCode, 'message' => '']);
            }
        }


        return parent::render($request, $e);
    }

}

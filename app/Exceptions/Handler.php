<?php

namespace App\Exceptions;

use App\Models\Brand;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
     * Report or log an exception.
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $code = $exception->getStatusCode();
            if($code == '403') {
                // (404)Page Not Found...
                return Response()->view('page-error.403', array(), 403);

            } elseif($code == '404') {
                // (403)Not Authorized/Forbidden...
                return Response()->view('page-error.404', array(), 403);

            } elseif($code == '500') {
                // (500)Internal/Server Error...
                return Response()->view('page-error.500', array(), 403);

            } else {
                // Normal Error...
                return Response()->view('page-error.normal-error', array(), 403);
            }

        }
        return parent::render($request, $exception);

    }


}

<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;
use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
        'current_password',
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
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     * @throws Throwable
     */
//    public function render($request, Exception $exception)
//    {
//        // 参数验证错误的异常，我们需要返回 400 的 http code 和一句错误信息
//        if ($exception instanceof ValidationException) {
//            return response(['error' => Arr::first(Arr::collapse($exception->errors()))], 400);
//        }
//        // 用户认证的异常，我们需要返回 401 的 http code 和错误信息
//        if ($exception instanceof UnauthorizedHttpException) {
//            return response($exception->getMessage(), 401);
//        }
//
//        return parent::render($request, $exception);
//    }


}

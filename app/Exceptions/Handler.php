<?php

namespace App\Exceptions;

use App\Facades\Common;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use InvalidArgumentException;
use Laka\Core\Http\Response\WebResponse;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    private $menuRepo;


    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     *
     * @throws Throwable
     */

    public function render($request, Throwable $e)
    {
        // Set default value for message,statusCode,menuLeft
        $message = "";
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        switch(get_class($e)) {
            case ValidatorException::class:
                $message = $e->getMessageBag();
                $code = Response::HTTP_NOT_ACCEPTABLE;
                return $this->response($code, $message, Route::has(Common::getSectionCode() . '.index'));
            break;
            case NotFoundHttpException::class:
                $$code = $e->getStatusCode();
                $message = $e->getMessage();
                return $this->response($code, $message);
            break;
            case FatalError::class:
            case ConnectionException::class:
            case InvalidArgumentException::class:
            case ModelNotFoundException::class:
                $message = $e->getMessage();
                return $this->response($code, $message);
            break;
            case AuthorizationException::class:
                $code = Response::HTTP_UNAUTHORIZED;
                $message = $e->getMessage();
                return Auth::check()
                    ? $this->response($code, $message)
                    : parent::render($request, $e);
            break;
            case TokenMismatchException::class:
                if (!Auth::check()) {
                    return WebResponse::exception(route('login'));
                }
            break;
            case HttpException::class:
                return $this->response($e->getStatusCode(), $e->getMessage());
            break;
        }
        return parent::render($request, $e);
    }

    private function redirect($message)
    {
        return WebResponse::exception(route(Common::getSectionCode() . '.index'), null, $message);
    }

    private function response($code, $message, $redirect = false)
    {
        if ($redirect)
            return $this->redirect($message);

        $data = [
            'status' => [
                'code' => $code,
                'name' => __("common.errors.http_{$code}")
            ]
        ];
        return WebResponse::success('errors.common', $data, $message);
    }
}

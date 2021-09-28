<?php

namespace App\Exceptions;

use App\Facades\Common;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use InvalidArgumentException;
use Laka\Core\Http\Response\WebResponse;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpFoundation\Response;
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
        $data['statusCode'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        //
        if ($e instanceof ValidatorException) {
            $message = $e->getMessageBag();
            return Route::has(Common::getSectionCode() . '.index')
                ? WebResponse::exception(route(Common::getSectionCode() . '.index'), null, $message)
                : WebResponse::success('errors.common', $data, $message);
        } elseif ($e instanceof NotFoundHttpException) {
            $data['statusCode'] = $e->getStatusCode();
            $message = __('common.page_not_found');
            return WebResponse::success('errors.common', $data, $message);

        } elseif ($e instanceof FatalError || $e instanceof ConnectionException || $e instanceof InvalidArgumentException || $e instanceof ModelNotFoundException) {
            $message = $e->getMessage();

            return WebResponse::success('errors.common', $data, $message);

        } elseif ($e instanceof AuthorizationException) {
            $data['statusCode'] = Response::HTTP_UNAUTHORIZED;
            $message = $e->getMessage();

            return Auth::check()
                ? WebResponse::success('errors.common', $data, $message)
                : parent::render($request, $e);

        }
        return parent::render($request, $e);
    }
}

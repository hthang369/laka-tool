<?php

namespace App\Exceptions;

use App\Facades\Common;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use InvalidArgumentException;
use Laka\Core\Http\Response\WebResponse;
use Prettus\Validator\Exceptions\ValidatorException;
use Psy\Exception\FatalErrorException;
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


        $message = $e->getMessage();
        $data['statusCode'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        View::share(['LEFTMENU' => null]);

        if ($e instanceof ValidatorException) {
            return WebResponse::exception(route(Common::getSectionCode() . '.index'), null, $e->getMessageBag()->toArray());
        } elseif ($e instanceof NotFoundHttpException) {
            $data['statusCode'] = $e->getStatusCode();
            $message = __('custom_message.page_not_found');
            return WebResponse::success('errors.common', $data, $message);

        } elseif ($e instanceof FatalErrorException || $e instanceof ConnectionException || $e instanceof InvalidArgumentException) {
            return WebResponse::success('errors.common', $data, $message);
        }

        return parent::render($request, $e);


    }
}

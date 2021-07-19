<?php

namespace App\Core\Http\Response;

use Illuminate\Contracts\Support\Arrayable;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse
{
    public static function success($data, $message = null)
    {
        if ($message === null) {
            $message = trans('response.success');
        }
        return static::makeResponse(true, Response::HTTP_OK, $message, $data);
    }

    public static function notModified()
    {
        return response(null, Response::HTTP_NOT_MODIFIED);
    }

    public static function error($message, int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return static::makeResponse(false, $code, $message);
    }

    public static function exception(int $code, string $message, array $errors = [], array $headers = [])
    {
        return static::makeResponse(false, $code, $message, null, $errors, $headers);
    }

    public static function created($data, $message = null)
    {
        if ($message === null) {
            $message = trans('response.created');
        }
        return static::makeResponse(true, Response::HTTP_CREATED, $message, $data);
    }

    public static function updated($data, $message = null)
    {
        if ($message === null) {
            $message = trans('response.updated');
        }
        return static::makeResponse(true, Response::HTTP_OK, $message, $data);
    }

    public static function deleted($message = null)
    {
        if ($message === null) {
            $message = trans('response.deleted');
        }
        return static::makeResponse(true, Response::HTTP_OK, $message);
    }

    public static function validateFail(array $errors, $message = null)
    {
        if ($message === null) {
            $message = trans('response.validation_fail');
        }
        return static::makeResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $message, null, $errors);
    }

    protected static function makeResponse(bool $success, int $code, string $message, $data = null, array $errors = [], array $headers = [])
    {
        $content = [
            'success' => $success,
            'message' => $message,
            'data'    => $data instanceof Arrayable ? $data->toArray() : $data,
            'errors'  => $errors
        ];

        return response($content, $code, $headers);
    }
}

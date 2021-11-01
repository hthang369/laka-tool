<?php

namespace App\Support;

use GuzzleHttp\Client;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class CommonHelper
{
    public function getSectionCode()
    {
        if (\is_null(Request::route())) return '';
        $routeName = explode('.', Request::route()->getName());
        return trim(head($routeName));
    }

    public function callApi($method, $url, $params = [])
    {
        if (filter_var($url, FILTER_VALIDATE_URL))
            $fullUrl = $url;
        else
            $fullUrl = config('laka.api_address') . "{$url}";

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                // 'Content-Type' => 'application/x-www-form-urlencoded',
                'token' => config('laka.api_token'),
                'userid'=>90,
            ])->{$method}($fullUrl, $params);

            if ($response->ok())
                return $response->collect();

            return $response->body();
        } catch(ConnectionException $e) {
            throw $e;
        }
    }
}

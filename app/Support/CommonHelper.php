<?php

namespace App\Support;

use GuzzleHttp\Client;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Laka\Core\Support\CommonSupport;

class CommonHelper extends CommonSupport
{
    public function callApi($method, $url, $params = [], $headers = [])
    {
        if (filter_var($url, FILTER_VALIDATE_URL))
            $fullUrl = $url;
        else
            $fullUrl = config('laka.api_address') . "{$url}";

        return parent::callApi($method, $fullUrl, $params, [
            'token' => config('laka.api_token'),
            'userid' => 90
        ]);
    }

    public function downloadFileToAws($awsName, $fileName, $pathName, $isUrl = true)
    {
        $storageAws = Storage::disk($awsName);
        $storageLocal = Storage::disk('local');
        $localPath = config("filesystems.disks.public.{$pathName}") . $fileName;

        if (!$storageLocal->exists($localPath)) {
            $storageLocal->put(
                $localPath,
                $storageAws->get($fileName)
            );
        }

        $link = $storageLocal->url($localPath);

        return ($isUrl) ? env('APP_URL') . $link : $link;
    }
}

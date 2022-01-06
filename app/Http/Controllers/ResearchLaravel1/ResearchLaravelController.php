<?php

namespace App\Http\Controllers\ResearchLaravel;

use Laka\Core\Http\Controllers\BaseController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;
use ReflectionClass;

class ResearchLaravelController extends BaseController
{
    public function list()
    {
        $classArr = [
            // Model::class,
            // Arr::class,
            // Str::class,
            // Route::class
            // Router::class
            // Builder::class
            // Facade::class
            Builder::class
        ];

        foreach($classArr as $class) {
            echo $class.PHP_EOL;
            $classReflection   = new ReflectionClass($class);
            // print_r(array_map(function($item) {
            //     return data_get($item, 'name');
            // }, $classReflection->getProperties()));
            // echo PHP_EOL;
            print_r(array_map(function($item) {
                return data_get($item, 'name');
            }, $classReflection->getMethods()));
        }
    }

    /**
     * @throws \Google_Exception
     * @author nhat_truong
     * @since  2018-11-15
     */
    private function getClient()
    {
        // $googleClient = new Google_Client();
        // $googleClient->setApplicationName('Google Sheets API PHP Quickstart');
        // $googleClient->setScopes(Google_Service_Sheets::SPREADSHEETS);
        // $googleClient->setAuthConfig(base_path(config('google_spreadsheets.credentials')));
        // $googleClient->setAccessType('offline');
        // $googleClient->setPrompt('select_account consent');

        // // Load previously authorized token from a file, if it exists.
        // $tokenPath = base_path(config('google_spreadsheets.token'));
        // if (file_exists($tokenPath)) {
        //     $accessToken = json_decode(file_get_contents($tokenPath), true);
        //     $googleClient->setAccessToken($accessToken);
        // }

        // // If there is no previous token or it's expired.
        // if ($googleClient->isAccessTokenExpired()) {
        //     // Refresh the token if possible, else fetch a new one.
        //     if ($googleClient->getRefreshToken()) {
        //         $googleClient->fetchAccessTokenWithRefreshToken($googleClient->getRefreshToken());
        //     } else {
        //         // Request authorization from the user.
        //         $authUrl = $googleClient->createAuthUrl();
        //         printf("Open the following link in your browser:\n%s\n", $authUrl);
        //         print 'Enter verification code: ';
        //         $authCode = trim(fgets(STDIN));

        //         // Exchange authorization code for an access token.
        //         $accessToken = $googleClient->fetchAccessTokenWithAuthCode($authCode);
        //         $googleClient->setAccessToken($accessToken);

        //         // Check to see if there was an error.
        //         if (array_key_exists('error', $accessToken)) {
        //             throw new \Exception(join(', ', $accessToken));
        //         }
        //     }
        //     // Save the token to a file.
        //     if (!file_exists(dirname($tokenPath))) {
        //         mkdir(dirname($tokenPath), 0700, true);
        //     }
        //     file_put_contents($tokenPath, json_encode($googleClient->getAccessToken()));
        // }

        // return $googleClient;
    }
}

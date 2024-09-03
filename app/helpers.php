<?php

use App\Helpers\Attributes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

define('SELF_SIGNED_SMTP_HOSTS', [
    'mail.lampart-vn.com'
]);

if (!function_exists('attributes_get')) {
    function attributes_get($items, $excludes = [])
    {
        return Attributes::get($items, $excludes);
    }
}

if (!function_exists('vn_str_filter')) {
    function vn_str_filter($str)
    {
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '_', $str);
        return $str;
    }
}

if (!function_exists('json_convert')) {
    function json_convert($string)
    {
        $result = json_decode($string);
        if (json_last_error() === JSON_ERROR_NONE)
            return $result;

        return $string;
    }
}

if (!function_exists('set_env')) {
    function set_env($name, $value)
    {
        $envFile = app()->environmentFilePath();

        $escaped = preg_quote('='.env($name), '/');

        file_put_contents($envFile, preg_replace(
            "/^{$name}{$escaped}/m",
            "{$name}={$value}",
            file_get_contents($envFile)
        ));
    }
}

if (!function_exists('dd_json')) {
    function dd_json($args) {
        print_r($args);die;
    }
}

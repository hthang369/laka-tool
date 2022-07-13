<?php

namespace Modules\LakaManager\Helpers;

use Carbon\Carbon;

/**
 * Class     LogParser
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HttpLogParser
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const REGEX_URL_PATTERN         = 'https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)';
    const REGEX_DATETIME_PATTERN    = '(\d{2})\/(\S+)\/(\d{4})[:](\d{2})[:](\d{2})[:](\d{2}) [+|-](\d{2})(\d{2})';
    const REGEX_IP_ADDRESS_PATTERN  = '(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)';
    const REGEX_METHOD_PATH_PATTERN = '(GET|POST|PUT|PATCH|DELETE) (\S+) (\S+)';
    // const REGEX_USER_AGANT_PATTERN  = '(?=.*\bMozilla\b)(?!.*\bmobile\b).*';
    const REGEX_USER_AGANT_PATTERN  = '"(\S+) (\S+) (\S+)';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Parsed data.
     *
     * @var array
     */
    protected static $parsed = [];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Parse file content.
     *
     * @param  string  $raw
     *
     * @return array
     */
    public static function parse($raw)
    {
        static::$parsed          = [];
        list($ipAddress, $dateTime, $methodPath, $url, $userAgant) = static::parseRawData($raw);
        $arr = explode(' ', $methodPath);

        static::$parsed = [
            'ip'    => $ipAddress,
            'url'    => $arr[1],
            'date_log'    => Carbon::parse($dateTime),
            'message'   => $methodPath.' '.$userAgant
        ];

        return array_reverse(static::$parsed);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Extract the date.
     *
     * @param  string  $string
     *
     * @return string
     */
    public static function extractUrl(string $string): string
    {
        return preg_replace('/.*('.self::REGEX_URL_PATTERN.').*/', '$1', $string);
    }

    /**
     * Extract the date time.
     *
     * @param  string  $string
     *
     * @return string
     */
    public static function extractDateTime(string $string): string
    {
        return preg_replace('/.*('.self::REGEX_DATETIME_PATTERN.').*/', '$1', $string);
    }

    /**
     * Extract the method path.
     *
     * @param  string  $string
     *
     * @return string
     */
    public static function extractMethodPath(string $string): string
    {
        return preg_replace('/.*('.self::REGEX_METHOD_PATH_PATTERN.').*/', '$1', $string);
    }

    /**
     * Extract the user agant.
     *
     * @param  string  $string
     *
     * @return string
     */
    public static function extractUserAgant(string $string): string
    {
        return preg_replace('/.*('.self::REGEX_USER_AGANT_PATTERN.').*/', '$1', $string);
    }

    /**
     * Parse raw data.
     *
     * @param  string  $raw
     *
     * @return array
     */
    private static function parseRawData($raw)
    {
        $ipAddress = self::extractIpAddress($raw);
        $dateTime = self::extractDateTime($raw);
        $methodPath = trim(self::extractMethodPath($raw), '"');
        $url = self::extractUrl($raw);
        $userAgant = trim(self::extractUserAgant($raw), '"');

        return [$ipAddress, $dateTime, $methodPath, $url, $userAgant];
    }

    public static function extractIpAddress(string $string): string
    {
        return preg_replace('/.*(^'.self::REGEX_IP_ADDRESS_PATTERN.').*/', '$1', $string);
    }
}

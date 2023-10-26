<?php


namespace App\Services;


class UrlService
{
    public static function getHostWithHttp()
    {
        return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }
}

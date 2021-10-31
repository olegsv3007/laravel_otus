<?php

/**
 * Функция для получения сегмента url
 */
if (!function_exists("get_url_segment")) {
    function get_url_segment(string $url, int $number): string {
        $url = parse_url($url, PHP_URL_PATH);
        $arr = explode('/', $url);
        if (isset($arr[$number])) {
            return $arr[$number];
        }
        return '';
    }
}

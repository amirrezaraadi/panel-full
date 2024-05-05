<?php


if ( ! function_exists('client_ip')) {
    function client_ip($withData = false)
    {

        $ip = $_SERVER['REMOTE_ADDR'] . '-' . md5($_SERVER['HTTP_USER_AGENT']);
        if($withData) {
            $ip .= '-' . now()->toDateString();
        }

        return $ip;
    }
}

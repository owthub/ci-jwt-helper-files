<?php

class AUTHORIZATION
{
    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false) {
            return $token;
        }
        return false;
    }

    public static function validateToken($token)
    {
        $CI =& get_instance();
        return JWT::decode($token, $CI->config->item('key'));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        $token = array(
           "iss" => $CI->config->item('iss'),
           "aud" => $CI->config->item('aud'),
           "iat" => $CI->config->item('iat'),
           "nbf" => $CI->config->item('nbf'),
           "exp" => $CI->config->item('exp'),
           "data" => $data
        );

        return JWT::encode($token, $CI->config->item('key'));
    }

}
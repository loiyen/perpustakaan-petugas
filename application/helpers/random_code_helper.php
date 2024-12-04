<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_random_code')) {
    /**
     * Generate a random code with specified length.
     *
     * @param int $length Length of the random code
     * @return string Random code
     */
    function generate_random_code($length = 6)
    {
        $characters = '0123456789';
        $random_code = '';

        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $random_code .= $characters[rand(0, $max)];
        }

        return $random_code;
    }
}

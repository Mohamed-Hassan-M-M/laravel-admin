<?php

if (!function_exists('setting')) {
    function setting($key = false, $defaultValue = false) { //edit mhmm

        if ($key === false) {
            return 'Key not found';
        }

        $value = config('custom.' . $key );
        return $value ? $value : $defaultValue;
    }
}

<?php

if (!function_exists('getPartialValidateRules')) {
    function getPartialValidateRules()
    {
        $rules = config('validation.patients');
        return json_encode($rules, JSON_FORCE_OBJECT);
    }
}

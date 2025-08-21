<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('sidebar_list')) {
    function sidebar_list()
    {
        return [
            (object) [
                'route' => 'nationality',
                'name' => 'nationality',
                'icon' => 'fa-user-secret',

            ],
            (object)  [
                'route' => 'branch',
                'name' => 'branch',
                'icon' => 'fa-building-o',
                'childs' => []
            ],
            (object)  [
                'route' => 'users',
                'name' => 'users',
                'icon' => 'fas fa-hospital-user',
                'childs' => []
            ],
            (object) [
                'route' => 'city',
                'name' => 'city',
                'icon' => 'fa-hospital-o',

            ],
            (object) [
                'route' => 'specification',
                'name' => 'specification',
                'icon' => 'fa-list-ul',

            ],
            (object) [
                'route' => 'nickname',
                'name' => 'nickname',
                'icon' => 'fa-lightbulb-o',

            ],
            (object) [
                'route' => 'drugs',
                'name' => 'drugs',
                'icon' => 'fa-file',

            ],
            (object) [
                'route' => 'lab_tests',
                'name' => 'lab_tests',
                'icon' => 'fa-file',

            ],
            (object) [
                'route' => 'xrays',
                'name' => 'xrays',
                'icon' => 'fa-file',

            ],

           
         
            (object) [
                'route' => 'departments',
                'name' => 'departments',
                'icon' => 'fa-hospital',
                'childs' => []
            ],
            (object) [
                'route' => 'services',
                'name' => 'services',
                'icon' => 'fa-hospital',
                'childs' => []
            ],

            (object) [
                'route' => 'doctor',
                'name' => 'doctor',
                'icon' => 'fa-user-md',
                'childs' => []
            ],
            (object) [
                'route' => 'patients',
                'name' => 'patients',
                'icon' => 'fas fa-person-booth',
                'childs' => []
            ],
        ];
    }
}
if (!function_exists('sidebar_icon')) {
    function sidebar_icon($icon = '')
    {
        if (empty($icon))
            return $icon;
        $icons = explode(' ', $icon);
        if (!in_array('fas', $icons) && !in_array('fa', $icons))
            $icon = 'fa ' . $icon;
       /*  if (!in_array('menu_icon', $icons))
            $icon = ' menu_icon ' . $icon; */
        $icon .= ' fa-fw';
        return $icon;
    }
}
if (!function_exists('sidebar_url')) {
    function sidebar_url($route = '', $local = true)
    {
        $route = ($local == true) ? app()->getLocale() . '/' . $route : $route;
        return  url($route);
    }
}
if (!function_exists('sidebar_title')) {
    function sidebar_title($title = '')
    {
        if (empty($title))
            return $title;

        return trans_title($title);
    }
}

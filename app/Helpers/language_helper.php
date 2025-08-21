<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function getPageDirection()
{
    return LaravelLocalization::getCurrentLocaleDirection();
}
function isArabicLanguage()
{
    return (getPageDirection() == 'rtl');
}
function getLocaleTitle()
{
    return LaravelLocalization::getCurrentLocaleNative();
}
function getLanguageMenu()
{
    $index = 0;
    $lng = LaravelLocalization::getSupportedLocales();
    $title = '';
    $currentLocale = LaravelLocalization::getCurrentLocale();
    $html = "<div class='dropdown-menu' style='min-width: auto !important;'> ";
    foreach ($lng as $localeCode => $properties) {
        if ($currentLocale == $localeCode) {
            $title = '<a class="btn btn-sm color-mode dropdown-toggle" id="lang-link" data-toggle="dropdown" href="#" aria-expanded="false"> ' . $properties['native'] . ' </a>';
        }
        $html .= '<a class="dropdown-item lang-itm" rel="alternate" hreflang="' . $localeCode . '" href="' . LaravelLocalization::getLocalizedURL($localeCode, null, [], true) . '"> <i class="fa fa-gloable"></i> ' . $properties["native"] . ' </a>';
        if ($index < sizeof($lng) - 1)
            $html .= " <div class='dropdown-divider'></div>";
        $index += 1;
    }
    $html .= '</div>';
    return  '<li class="nav-item dropdown" id="lang-container">' . $title . $html . '</li>';
}

if (!function_exists('fa_angle_class')) {
    /**
     * Get  class name by language direction
     *
     * @return string
     */
    function fa_angle_class()
    {
        return (isArabicLanguage()) ? ' fa-angle-left' : ' fa-angle-right';
    }
}

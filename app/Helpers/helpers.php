<?php
use App\Models\Branch;
use App\Models\City;
use App\Models\Doctor;
use App\Utilities\BranchDataSession;
use Carbon\Carbon;
function getDiffBetweenTwoDate($startDate, $endDate, $formate = 'a')
{
    $fdate = $startDate;
    $tdate = $endDate;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');
    return $days;
}
function getDiffBetweenTwoDateIMinute($startDate, $endDate)
{
    $to = Carbon::createFromFormat('Y-m-d H:i:s', $endDate);
    $from = Carbon::createFromFormat('Y-m-d H:i:s', $startDate);
    return $diff_in_minutes = $to->diffInMinutes($from);
}
function getDiffinSeconds($created_date)
{
    return Carbon::now()->diffInSeconds(Carbon::parse($created_date));
}
function getSeconds($hours, $mins, $secs)
{
    return ($hours * 60 * 60) + ($mins * 60) + ($secs);
}
function getBranchById($branchId)
{
    $branch = Branch::find($branchId);
    if ($branchId)
        return $branch->name_ar;
    else
        return '';
}
function getBranchDays()
{
   
    if (Auth::user()) {
       return BranchDataSession::getBranchDays();
    }
   
    return array();
}
function getBranchTitle()
{
    if (Auth::user()) {
        return BranchDataSession::getBranchTitle();
    }
    return (object)['title' => '', 'logo' => asset('images/logo.png')];
}
function maskPhoneNumber($number)
{
    $mask_number = str_repeat("x", (strlen($number)) - 4) . substr($number, -4);
    return $mask_number;
}
if (!function_exists('getCompactDataArray')) {
    function getCompactDataArray($value = null)
    {
        if (is_null($value))
            return [];
        if (is_array($value) || is_object($value))
            return json_encode($value, JSON_FORCE_OBJECT);
        return  $value;
    }
}
if (!function_exists('getWeekDaysList')) {
    function getWeekDaysList()
    {
        return  [
            'Saturday',
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday'
        ];
    }
}
if (!function_exists('getItemStatusList')) {
    function getItemStatusList()
    {
        return  [1 => trans('m.actived'), 0 => trans('m.un_actived')];
    }
}
if (!function_exists('getServiceTypeList')) {
    function getServiceTypeList()
    {
        return  [1 => trans('m.notfree'), 0 => trans('m.free')];
    }
}
if (!function_exists('getBloodGroupList')) {
    function getBloodGroupList()
    {
        return  ["O+" => "O+", "O-" => "O-", "A+" => "A+", "A-" => "A-", "B+" => "B+", "B-" => "B-", "AB+" => "AB+", "AB-" => "AB-",];
    }
}
if (!function_exists('getCitiesList')) {
    function getCitiesList()
    {
        return City::pluck('name_ar', 'id');
    }
}
if (!function_exists('getInputValue')) {
    function getInputValue($value, $def = null)
    {
        return  !isset($value) || ((is_null($value) || empty($value)) && !is_null($def)) ? $def : $value;
    }
}
if (!function_exists('isCurrentRoute')) {
    function isCurrentRoute($route)
    {
        $prefix = Route::current()->getAction()['prefix'];
        $rot = explode('/', $prefix);
        return $rot[sizeof($rot) - 1] == $route;
    }
}
if (!function_exists('getCurrentRoutePrefix')) {
    function getCurrentRoutePrefix()
    {
        $prefix = Route::current()->getAction()['prefix'];
        $rot = explode('/', $prefix);
        return $rot[sizeof($rot) - 1];
    }
}

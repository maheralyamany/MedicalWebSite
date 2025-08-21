<?php

namespace App\Utilities;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchDataSession
{
    private static $_branch;
    private static $_branchTitle;
    private static $_working_days;
    public static function initBranchData()
    {
        if (static::$_branch === null) {
            static::$_branch =  Branch::find(Auth::user()->branch_id);
            static::$_branchTitle =  (object)['title' => static::$_branch->getTransName(), 'logo' => static::$_branch->getBranchLogo()];
            static::$_working_days = (!empty(static::$_branch->working_days) && !is_null(static::$_branch->working_days)) ? static::$_branch->working_days : array();
        }
    }
    public static function clear()
    {
        static::$_branch = null;
        static::$_working_days = null;
        static::$_branchTitle = null;
    }
    public static function getBranchTitle()
    {
        static::initBranchData();
        return  static::$_branchTitle;
    }
    public static function getBranchDays()
    {
        static::initBranchData();
        if (!isset(static::$_working_days) || is_null(static::$_working_days))
            static::$_working_days = array();
        return  static::$_working_days;
    }
}

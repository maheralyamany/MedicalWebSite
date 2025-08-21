<?php

namespace App\Traits\Dashboard;


use App\Models\Branch;
use App\Utilities\MLaratables;

use Illuminate\Support\Facades\DB;

trait BranchTrait
{



    // Branches
    public function getAllBranches($queryStr)
    {
        return Branch::where('name_en', 'LIKE', '%' . trim($queryStr) . '%')->orWhere('name_ar', 'LIKE', '%' . trim($queryStr) . '%');

       
    }


    public function checkMobileExists($mobile)
    {
        $exists = Branch::where('mobile', $mobile)->first();
        if ($exists) {
            return true;
        }
        return false;
    }



    public static function getBranchNameById($branch_id)
    {
        $provider = Branch::find($branch_id);
        if (!$provider)
            return '--';

        return $provider->name_ar ;
    }
}

<?php

namespace App\Traits\Dashboard;

use App\Models\Specification;
use App\Utilities\MLaratables;

trait SpecificationTrait
{
    public function getSpecificationById($id){
        return Specification::find($id);
    }

   
    public function createSpecification($request){
        $company = Specification::create($request->all());
        return $company;
    }

    public function updateSpecification($specification, $request){
        $specification = $specification->update($request->all());
        return $specification;
    }

    public static function getSpecificationNameById($specification_id){
        $specification = Specification::find($specification_id);
        if(!$specification)
            return '--';
        return $specification -> {'name_'.app()->getLocale()};

    }

}

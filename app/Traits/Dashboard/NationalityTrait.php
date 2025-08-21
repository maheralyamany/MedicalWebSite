<?php

namespace App\Traits\Dashboard;
use App\Models\Nationality;
use App\Utilities\MLaratables;


trait NationalityTrait
{
    public function getNationalityById($id){
        return Nationality::find($id);
    }

    public function getAll(){
        return MLaratables::recordsOf(Nationality::class, function ($query) {
            return $query->with('doctors');
        });
    }

    public function createNationality($request){
        $nationality = Nationality::create($request->all());
        return $nationality;
    }

    public function updateNationality($nationality, $request){
        $nationality = $nationality->update($request->all());
        return $nationality;
    }
    
}
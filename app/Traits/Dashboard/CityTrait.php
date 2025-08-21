<?php

namespace App\Traits\Dashboard;
use App\Models\City;
use App\Utilities\MLaratables;


trait CityTrait
{
    public function getCityById($id){
        return City::find($id);
    }

    public function getAll(){
        return MLaratables::recordsOf(City::class);
    }

    public function createCity($request){
        $city = City::create($request->all());
        return $city;
    }

    public function updateCity($city, $request){
        $city = $city->update($request->all());
        return $city;
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends BaseModel
{
    protected $table = 'cities';
    protected $fillable = ['name_en', 'name_ar'];
    public static function laratablesCustomAction($city)
    {
        return view('city.actions', compact('city'))->render();
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'city_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends BaseModel
{
    protected $table = 'nationalities';


    protected $fillable = ['name_en', 'name_ar'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'nationality_id');
    }

    public static function laratablesCustomAction($nationality)
    {
        return view('nationality.actions', compact('nationality'))->render();
    }

}

<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

class Nickname extends BaseModel
{
    use StatusTrait;
    protected $table = 'doctor_nicknames';


    protected $fillable = ['name_en', 'name_ar', 'status'];

    public static function laratablesCustomAction($nickname)
    {
        return view('nickname.actions', compact('nickname'))->render();
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'nickname_id', 'id');
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardType extends BaseModel
{
    protected $table = 'card_types';
    protected $fillable = ['name_en', 'name_ar'];
    public static function laratablesCustomAction($card_type)
    {
        return view('card_type.actions', compact('card_type'))->render();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugType extends BaseModel
{
    protected $table = 'drug_types';
    protected $fillable = ['name_en', 'name_ar'];

    public function drugs()
    {
        return $this->hasMany(Drug::class, 'type_id', 'id');
    }

}

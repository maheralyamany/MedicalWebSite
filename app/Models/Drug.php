<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends BaseModel
{
    use StatusTrait;
    protected $table = 'drugs';
    protected $fillable = [  'name_ar', 'name_en', 'description', 'type_id', 'status',];
  
    protected $forcedNullStrings = ['description'];
    public function drugType()
    {
        return $this->belongsTo(DrugType::class, 'type_id');
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'drug_id');
    }
}

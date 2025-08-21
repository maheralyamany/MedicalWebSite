<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xray extends BaseModel
{
    use StatusTrait;
    protected $table = 'xrays';
    protected $fillable = ['name_en', 'name_ar','xray_time','price', 'status'];

    public function patientXrays()
    {
        return $this->hasMany(PatientXray::class, 'xray_id', 'id');
    }
}

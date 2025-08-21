<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends BaseModel
{
    use StatusTrait;
    protected $table = 'lab_tests';
    protected $fillable = ['name_en', 'name_ar','test_time','price', 'status'];
   
    public function patientTests()
    {
        return $this->hasMany(PatientTest::class, 'test_id', 'id');
    }

}

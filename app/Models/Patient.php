<?php

namespace App\Models;

use App\Traits\GlobalTrait;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends BaseModel
{
    use  GlobalTrait;

    protected $table = 'patients';

    protected $fillable = ['patientname', 'mobile', 'email', 'gender', 'city_id', 'address', 'age', 'photo', 'bloodgroup',];
    protected $hidden = ['city_id', 'pivot',];
    public function getPatientPhoto()
    {
        return ($this->photo != null && $this->photo != "" ? asset($this->photo) : asset('images/img.png'));
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault(["id" => null, "name_ar" => ""]);
    }
   
    public function doctors() {
        return $this->belongsToMany(Doctor::class, Appointments::class, 'patient_id', 'doctor_id');
     }
     public function appointments()
     {
         return $this->hasMany(Appointments::class, 'patient_id');
     }
}

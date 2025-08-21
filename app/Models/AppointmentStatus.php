<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends BaseModel
{

    protected $table = 'appointment_status';


    protected $fillable = ['name_en', 'name_ar'];



    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'status_id', 'id');
    }



}

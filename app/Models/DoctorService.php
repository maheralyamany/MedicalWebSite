<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorService extends BaseModel
{
    protected $table = 'doctor_services';
    protected $fillable = [ 'service_id', 'doctor_id'];
}

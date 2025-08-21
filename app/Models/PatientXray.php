<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientXray   extends BaseModel
{
    protected $table = 'patient_xrays';
    protected $fillable = [  'xray_id', 'appointment_id', 'xray_date', 'qty', 'total_cost', 'user_id', 'discharge_date',];
    protected $hidden = ['xray_id', 'appointment_id', 'user_id',];
    public static function laratablesCustomAction($patient_xray)
    {
        return view('patient_xray.actions', compact('patient_xray'))->render();
    }
    public function xray()
    {
        return $this->belongsTo(Xray::class, 'xray_id');
    }
    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }
    public function patient()
    {
        return $this->appointment()->patient();
    }
    public function doctor()
    {
        return $this->appointment()->doctor();
    }
    public function patientXrayFiles()
    {
        return $this->hasMany(PatientXrayFile::class, 'patient_xray_id');
    }
}

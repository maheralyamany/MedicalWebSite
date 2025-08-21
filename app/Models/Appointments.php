<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends BaseModel
{
    protected $table = 'appointments';
    protected $fillable = [  'patient_id', 'doctor_id', 'status_id', 'service_id', 'appointment_date', 'appointment_time', 'price',];
    protected $hidden = ['patient_id', 'doctor_id', 'status_id', 'service_id',];
    public static function laratablesCustomAction($appointment)
    {
        return view('appointments.actions', compact('appointment'))->render();
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function appointmentTests()
    {
        return $this->hasMany(PatientTest::class, 'appointment_id');
    }
    public function appointmentXrays()
    {
        return $this->hasMany(PatientXray::class, 'appointment_id');
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'appointment_id');
    }
    public function patientReview()
    {
        return $this->hasMany(PatientReview::class, 'appointment_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function appointmentStatus()
    {
        return $this->belongsTo(AppointmentStatus::class, 'status_id');
    }
}

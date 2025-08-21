<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest  extends BaseModel
{
    protected $table = 'patient_tests';
    protected $fillable = [  'test_id', 'appointment_id', 'test_date', 'quantity', 'total_cost', 'user_id', 'discharge_date',];
    protected $hidden = ['test_id', 'appointment_id', 'user_id',];
    public static function laratablesCustomAction($patient_test)
    {
        return view('patient_test.actions', compact('patient_test'))->render();
    }
    public function labTest()
    {
        return $this->belongsTo(LabTest::class, 'test_id');
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
    public function patientTestFiles()
    {
        return $this->hasMany(PatientTestFile::class, 'patient_test_id');
    }
}

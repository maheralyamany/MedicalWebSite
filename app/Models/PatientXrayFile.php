<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientXrayFile   extends BaseModel
{
    protected $table = 'patient_xray_files';
    protected $fillable = [ 'patient_xray_id','upload_date','path','notes'];
    protected $hidden = ['patient_xray_id'];
    public static function laratablesCustomAction($xray_file)
    {
        return view('patient_xray_file.actions', compact('xray_file'))->render();
    }
    public function patientXray()
    {
        return $this->belongsTo(PatientXray::class, 'patient_xray_id');
    }
    public function patient()
    {
        return $this->patientXray()->patient();
    }
    public function doctor()
    {
        return $this->patientXray()->doctor();
    }
}

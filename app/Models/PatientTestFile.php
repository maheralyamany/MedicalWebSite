<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PatientTestFile   extends BaseModel
{
    protected $table = 'patient_test_files';
    protected $fillable = [ 'patient_test_id','upload_date','path','notes'];
    protected $hidden = ['patient_test_id'];
    public static function laratablesCustomAction($test_file)
    {
        return view('patient_test_file.actions', compact('test_file'))->render();
    }
    public function patientTest()
    {
        return $this->belongsTo(PatientTest::class, 'patient_test_id');
    }
    public function patient()
    {
        return $this->patientTest()->patient();
    }
    public function doctor()
    {
        return $this->patientTest()->doctor();
    }
}

<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class DoctorTime extends BaseModel
{
    protected $table = 'doctor_times';
    protected $fillable = [ 'doctor_id', 'service_id', 'day_name', 'start_time', 'end_time', 'order',];
    protected $hidden = ['doctor_id',  'service_id'];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

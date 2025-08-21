<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class ServiceTime extends BaseModel
{
    protected $table = 'service_times';
    protected $fillable = [ 'service_id', 'day_name', 'start_time', 'end_time', 'order',];
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
  
}

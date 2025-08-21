<?php

namespace App\Models;

use App\Traits\DoctorTrait;
use App\Traits\GlobalTrait;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseModel
{
    use  GlobalTrait, StatusTrait;
    protected $table = 'services';
    protected $forcedNullNumbers = ['price'];
    protected $fillable = ['service_name',  'department_id', 'has_price', 'price', 'status',];
    protected $casts = [
        'status' => 'boolean',
        'has_price' => 'boolean',
    ];
    protected $hidden = ['pivot',  'department_id'];
    public static function laratablesCustomAction($service)
    {
        return view('services.actions', compact('service'))->render();
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'service_id', 'id');
    }
    public function serviceTimes()
    {
        return $this->hasMany(ServiceTime::class, 'service_id', 'id');
    }
    public function doctorTimes()
    {
        return $this->hasMany(DoctorTime::class, 'service_id', 'id');
    }
    public function serviceDoctors()
    {
        return $this->hasMany(DoctorService::class, 'service_id','id');
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, DoctorService::class, 'service_id', 'doctor_id');
    }
    public function getPriceAttribute($price)
    {
        return ($price != null ? $price : 0);
    }

    /* public function getHasPriceAttribute($has_price)
    {
        return $has_price == 1 ? true : false;
    } */
    public function getIsFree()
    {
        return ($this->has_price == 1 ? trans('m.notfree') :  trans('m.free'));
    }

   
}

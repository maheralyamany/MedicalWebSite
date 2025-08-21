<?php
namespace App\Models;

use App\Traits\Dashboard\DoctorTrait;
use App\Traits\GlobalTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
class Doctor extends BaseModel
{
    use DoctorTrait, GlobalTrait, Notifiable;
    protected $table = 'doctors';

    protected $fillable = [ 'user_id', 'nickname_id', 'specification_id', 'nationality_id', 'consulting_price', 'salary',];
    protected $hidden = ['specification_id', 'nationality_id', 'nickname_id', 'pivot',];
    protected $forcedNullNumbers = ['salary','consulting_price'];
    public function scopeActive($query)
    {
        return $query->whereHas('user', function ($q)  { $q->Active(); });
    }
   
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function nickname()
    {
        return $this->belongsTo(Nickname::class, 'nickname_id')->withDefault(["name_ar" => ""]);
    }

    public function doctorServices()
    {
        return $this->hasMany(DoctorService::class, 'doctor_id','id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, DoctorService::class, 'doctor_id', 'service_id');
    }
    public function patients()
    {
        return $this->belongsToMany(Patient::class, Appointments::class, 'doctor_id', 'patient_id');
    }
    public function specification()
    {
        return $this->belongsTo(Specification::class, 'specification_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id')->withDefault(["name_ar" => ""]);
    }
    public function doctorTimes()
    {
        return $this->hasMany(DoctorTime::class, 'doctor_id', 'id')->orderBy('order');
    }
    public function getAvailableTimeAttribute()
    {
        try {
            $days = $this->times;
            $match = $this->getMatchedDateToDays($days);
            if (!$match || $match['date'] == null)
                return null;
            $doctorTimesCount = $this->getDoctorTimePeriodsInDay($match['day'], $match['day']['day_code'], true);
            $availableTime = $this->getFirstAvailableTime($this->id, $doctorTimesCount, $days, $match['date'], $match['index']);
            if (count((array)$availableTime))
                return $availableTime['date'] . ' ' . $availableTime['from_time'];
            else
                return null;
        } catch (\Exception $ex) {
            return null;
        }
    }
    public function getSalaryAttribute($val)
    {
        return ($val !== null ? $val : 0);
    }
    public function getConsultingPriceAttribute($val)
    {
        return ($val !== null ? $val : 0);
    }
}

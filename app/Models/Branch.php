<?php
namespace App\Models;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Branch extends BaseModel
{
    use StatusTrait;
    protected $table = 'branches';
    //because value may send in 1 or '1'  i ensure it is integr only accept 1 not '1'
    protected $casts = [
        'status' => 'boolean'
    ];
    protected $fillable = [ 'name_ar', 'name_en', 'email', 'mobile', 'address', 'status', 'logo','working_days'];

 /*    public function getLogoAttribute($val)
    {
        return ($val != null && $val != "" ? asset($val) : "");
    } */
    public function getBranchLogo()
    {
        return ($this->logo != null && $this->logo != "" ? asset($this->logo) : asset('images/logo.png'));
    }
    public function getAddressAttribute($val)
    {
        return ($val != null ?  $val : "");
    }
    public function getWorkingDaysAttribute($working_days)
    {
        return json_decode($working_days, true);
    }

    public function checkHasServiceTime($day)
    {
        if(( isset($this->working_days) && is_array($this->working_days) && in_array($day, $this->working_days))){
          return  ServiceTime::where('day_name',$day)->count()>0;
        }
        return false;
    }

    public function departments()
    {
        return $this->hasMany(Department::class, 'branch_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'branch_id', 'id');
    }
}

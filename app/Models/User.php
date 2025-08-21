<?php

namespace App\Models;
/* use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract; */

use App\Traits\HasPermissionsTrait;
use App\Traits\StatusTrait;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable, HasPermissionsTrait, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, StatusTrait;
    //
    protected $table = 'users';
    protected $forcedNullStrings = ['email', 'address', 'birth_date'];
    protected $forcedNullNumbers = ['card_type_id', 'id_card'];
    protected $casts = ['status' => 'boolean',];
    protected $fillable = ['name_ar', 'name_en', 'gender', 'mobile', 'email', 'password', 'status', 'group_id', 'id_card', 'card_type_id', 'birth_date', 'address', 'photo','branch_id'];
    protected $hidden = ['password', 'pivot'];

   /*  public function getPhotoAttribute($val)
    {
        return ($val != null && $val != "" ? asset($val) : "");
    } */
    public function getUserPhoto()
    {
        return ($this->photo != null && $this->photo != "" ? asset($this->photo) : asset('images/male.png'));
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function userGroup()
    {
        return $this->belongsTo(UsersGroup::class, 'group_id', 'id');
    }
    public function isAdmin()
    {
        return $this->userGroup->name == 'admin';
    }
    public function cardType()
    {
        return $this->belongsTo(CardType::class, 'card_type_id')->withDefault(["id" => null, "name_ar" => ""]);
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id', 'id');
    }
    public function scopeActiveDoctor($query)
    {
        return $query->where('status', 1);
    }
    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     */
    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->password =md5($password);
        }
    }
    public function getGender()
    {
        if ($this->gender == 'male') {
            return "ذكر";
        } elseif ($this->gender == 'female') {
            return "أنثي";
        } else
            return "غير محدد";
    }
    public function getFullName()
    {
        return $this -> {'name_'.app()->getLocale()};
    }
}

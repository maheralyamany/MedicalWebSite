<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends BaseModel
{
    public $timestamps = false;
    protected $hidden =['pivot'];
    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_permissions', 'permission_id', 'role_id');
     }

     public function users() {
        return $this->belongsToMany(User::class, 'users_permissions', 'permission_id', 'user_id');
     }
}

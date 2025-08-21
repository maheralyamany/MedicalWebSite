<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends BaseModel
{
    use StatusTrait;
    protected $table =  'departments';
    protected $fillable = ['name_en','name_ar', 'branch_id', 'status'];
    protected $hidden = ['branch_id'];
    protected $casts = ['status' => 'boolean',];

    public static function laratablesCustomAction($department)
    {
        return view('departments.actions', compact('department'))->render();
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'department_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

}

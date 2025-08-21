<?php
namespace App\Models;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
class Specification extends BaseModel
{
    use StatusTrait;
    protected $table = 'specifications';
    protected $fillable = ['name_en', 'name_ar','status'];
    public static function laratablesCustomAction($specification)
    {
        return view('specification.actions', compact('specification'))->render();
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'specification_id', 'id');
    }


}

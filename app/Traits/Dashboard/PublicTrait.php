<?php

namespace App\Traits\Dashboard;

use App\Models\Branch;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Nationality;
use App\Models\Nickname;
use App\Models\Specification;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

trait PublicTrait
{
    public function getBranchById($id)
    {
        return Branch::find($id);
    }
    public function getUser($id)
    {
        return User::find($id);
    }
    public function getAllCities()
    {
        return City::pluck('name_ar', 'id');
    }
  
    public function getAllSpecifications()
    {
        return Specification::pluck('name_ar', 'id');
    }
    public function getAllNicknames()
    {
        return Nickname::pluck('name_ar', 'id');
    }
    public function getAllNationalities()
    {
        return Nationality::pluck('name_ar', 'id');
    }
    public function getAllActiveDoctors()
    {
        return DB::table('users')
            ->join('doctors', 'users.id', '=', 'doctors.user_id')
            ->where('users.status', '1')
            ->select('doctors.id', 'users.name_ar as name')
            ->get()->pluck('name', 'id');
    }
    public function getActiveDoctors()
    {
        return DB::table('users')
            ->join('doctors', 'users.id', '=', 'doctors.user_id')
            ->where('users.status', '1')
            ->select('doctors.*','users.*')
            ->get();
    }
    public function getBranchesList()
    {
        return Branch::Active()->select('id', DB::raw('name_' . app()->getLocale() . ' as name'))->get()->pluck('name', 'id');
    }
}

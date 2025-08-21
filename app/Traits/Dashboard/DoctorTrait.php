<?php

namespace App\Traits\Dashboard;

use App\Models\Doctor;
use App\Models\DoctorTime;
use App\Utilities\MLaratables;
use Illuminate\Support\Facades\DB;

trait DoctorTrait
{
    public function findDoctor($id)
    {
        $doctor = Doctor::with('user')->find($id);
        return $doctor;
    }
    public function getDoctorByID($id)
    {
        $doctor = Doctor::with([
            'user',
            'doctorTimes',
            'services', 'specification' => function ($q1) {
                $q1->select('id', DB::raw('name_' . app()->getLocale() . ' as name'));
            }, 'nationality' => function ($q2) {
                $q2->select('id', DB::raw('name_' . app()->getLocale() . ' as name'));
            }, 'nickname' => function ($q3) {
                $q3->select('id', DB::raw('name_' . app()->getLocale() . ' as name'));
            }
        ])->find($id);
        return $doctor;
    }
   
    public function getAll($queryStr)
    {
        return MLaratables::recordsOf(Doctor::class, function ($query) use ($queryStr) {
            return $query->with(['user' => function ($q) use ($queryStr) {
                $q->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')->orWhere('name_en', 'LIKE', '%' . trim($queryStr) . '%')->select("*");
            }])->select('*');
        });
    }
    public function getDoctorTimes($doctorId, $service_id = 0)
    {
        if ($service_id == 0)
            return DoctorTime::where('doctor_id', $doctorId)->orderBy('order')->get();
        return DoctorTime::where('doctor_id', $doctorId)->where('service_id', $service_id)->orderBy('order')->get();
    }
    public function getDoctorDays($doctorId)
    {
        return DoctorTime::where('doctor_id', $doctorId)->groupBy('day_code')->orderBy('day_code')->pluck('day_code');
    }
   
   
    
    public static function getDoctorNameById($doctor_id)
    {
        $doctor = Doctor::with('user')->find($doctor_id);
        if (!$doctor)
            return '';
        return $doctor->user()->getFullName();
    }
}

<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;
use MercurySeries\Flashy\Flashy;

trait WorkTimeTrait
{
    public function getWorkTimesArray($times = null)
    {
        $dayKeys = getBranchDays();
        $timesArray = [];
        $timesCount = ($times == null) ? 0 : count($times);
        $order = 1;
        foreach ($dayKeys as $dayName) {
            $hasDay = 0;
            if ($timesCount > 0)
                foreach ($times as $obj) {
                    if ($obj['day_name'] === $dayName) {
                        $timesArray[] = [
                            "day_name" => $dayName,
                            "order" => $order,
                            "start_time" => $obj['start_time'],
                            "end_time" => $obj['end_time']
                        ];
                        $order++;
                        $hasDay++;
                    }
                }
            if ($hasDay == 0) {
                $timesArray[] = [
                    "day_name" => $dayName,
                    "order" => $order,
                    "start_time" => "",
                    "end_time" => ""
                ];
                $order++;
            }
        }
        return $timesArray;
    }
    public function getWorkingDays(Request $request, $doctor_id = null)
    {
        // working days
        $working_days_data = [];
        $days = getBranchDays();
        $order = 1;
        foreach ($request->workingDay as $id => $workingDay) {
            foreach ($workingDay as $dayKey => $dayValues) {
                if (!in_array($dayKey, $days)) {
                    $msg = trans('m.out_branch_working', ['day' => $dayKey]);
                    Flashy::error($msg);
                    return $msg;
                }
                foreach ($dayValues as $dayIndex => $day) {
                    $from = Carbon::parse($day['from']);
                    $to = Carbon::parse($day['to']);
                    $arr = [
                        'day_name' => $dayKey,
                        'start_time' => $from->format('H:i'),
                        'end_time' => $to->format('H:i'),
                        'order' => $order,
                        'service_id' => $id,
                    ];
                    if (!is_null($doctor_id))
                        $arr['doctor_id'] = $doctor_id;
                    $working_days_data[] = $arr;
                    $order++;
                }
            }
        }
        return $working_days_data;
    }
    public function getDoctorWorkingDays($serviceTimes, $doctor_id)
    {
        $working_days_data = [];
        if (!isset($serviceTimes) || is_null($serviceTimes))
            return $working_days_data;
        $days = getBranchDays();
        foreach ($serviceTimes as $it ) {
            if (in_array($it->day_name, $days)) {
                $arr = [
                    'day_name' => $it->day_name,
                    'start_time' =>$it->start_time,
                    'end_time' => $it->end_time,
                    'order' => $it->order,
                    'service_id' =>$it->service_id,
                    'doctor_id' =>$doctor_id,
                ];
                $working_days_data[] = $arr;
            }
        }
        return $working_days_data;
    }
}

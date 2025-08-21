<?php

namespace App\Traits;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait AppointmentsTrait
{
    public function createAppointment(Request $request)
    {

        $appointment = Appointments::where([
            ['patient_id', '=', $request->patient_id],
            ['doctor_id', '=', $request->doctor_id],
            ['service_id', '=', $request->service_id],
        ])->get()->first();
        $parms = [
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'status_id' => $request->status_id ?? 1,
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date ?? Carbon::now()->format('Y-m-d'),
            'appointment_time' => $request->appointment_time ?? Carbon::now()->format('H:i:s'),
            'price' => $request->price,
        ];
        if ($appointment == null) {

            if (!$request->has('appointment_date'))

                $appointment = Appointments::create($parms);
        } else {
            $appointment->update($parms);
        }
        return $appointment;
    }
}

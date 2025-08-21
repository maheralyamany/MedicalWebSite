<?php

namespace App\Http\Controllers;

use App\Traits\Dashboard\DoctorTrait;
use App\Traits\Dashboard\PublicTrait;

use Illuminate\Http\Request;
use App\Models\Doctor;

use App\Http\Controllers\Controller;

use App\Models\CardType;
use MercurySeries\Flashy\Flashy;

use Illuminate\Support\Facades\Validator;

use App\Models\DoctorTime;
use App\Models\Service;
use App\Models\UsersGroup;
use App\Traits\Dashboard\UserTrait;
use App\Traits\UploadFiles;

use App\Traits\WorkTimeTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    use DoctorTrait, PublicTrait, UserTrait, WorkTimeTrait;
    public function getDataTable()
    {
        try {
            $queryStr = request('queryStr');
            return $this->getAll($queryStr);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public static function getDataByQueryStr($queryStr)
    {
        $data = [];
        $data['doctors'] = Doctor::with(['user' => function ($q) use ($queryStr) {
            $q->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')->orWhere('name_en', 'LIKE', '%' . trim($queryStr) . '%')->select("*");
        }])->whereHas('user')
            ->orderBy('id', 'DESC')
            ->paginate(PAGINATION_COUNT);
        return view('doctor.index', $data);
    }
    public function index()
    {
        $data = [];
        $data['doctors'] = Doctor::with(['user', 'nickname', 'services', 'specification', 'nationality', 'doctorTimes'])
            ->orderBy('id', 'DESC')
            ->paginate(PAGINATION_COUNT);
        return view('doctor.index', $data);
    }
    public function view($id)
    {
        try {
            //$doctor = Doctor::with([ 'user', 'doctorTimes', 'specification', 'nationality', 'nickname' ])->find($id);
            $doctor = Doctor::find($id);
            if ($doctor == null)
                return $this->getErrorView(trans('m.not_found'));
            return view('doctor.view', compact('doctor'));
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function create()
    {
        $data = $this->getFormData();
        if ($data == null)
            return $this->getErrorView(trans('m.not_found'));
        return view('doctor.create', $data);
    }
    public function getFormData($id = null)
    {
        try {
            $data = [];
            $doctor = (isset($id) && $id != null) ? Doctor::find($id) : null;
            if ((isset($id) && $id != null) && $doctor == null)
                return null;
            $data['doctorServices'] = [];
            if ($doctor != null) {
                $data['doctor'] = $doctor;

                $doctorServices = $doctor->services()->get();
                if ((count($doctorServices) > 0))
                    foreach ($doctorServices as $s)
                        $data['doctorServices'][] = $s->id;
            }
            $data['branches'] = $this->getBranchesList();
            $data['specifications'] = $this->getAllSpecifications();
            $data['services'] = Service::with('appointments')->get();
            $data['nicknames'] = $this->getAllNicknames();
            $data['nationalities'] = $this->getAllNationalities();
            //trans namd of all days
            $data['days'] = ['Saturday' => 'السبت', 'Sunday' => 'الأحد', 'Monday' => 'الإثنين ', 'Tuesday' => 'الثلاثاء', 'Wednesday' => 'الأربعاء', 'Thursday' => 'الخميس ', 'Friday' => 'الجمعة '];
            $data['days_ar'] = ['السبت' => 'Saturday', 'الأحد' => 'Sunday', 'الإثنين ' => 'Monday', 'الثلاثاء' => 'Tuesday', 'الأربعاء' => 'Wednesday', 'الخميس ' => 'Thursday', 'الجمعة ' => 'Friday '];
            $data['usersType'] = UsersGroup::pluck('name', 'id');
            $data['cardTypes'] = CardType::pluck('name_ar', 'id');
            $data['genders'] = ['male' => trans('m.male'), 'female' => trans('m.female')];
            return $data;
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function edit($id)
    {
        $data = $this->getFormData($id);
        if ($data == null)
            return $this->getErrorView(trans('m.not_found'));
        return view('doctor.edit', $data);
    }
    public  function getDoctorValidatorRules($id, $hasPassword)
    {
        $ValidatorRules = $this->getUserValidatorRules($id, $hasPassword);
        $ValidatorRules["nickname_id"]  = "required|numeric|exists:doctor_nicknames,id";
        $ValidatorRules["specification_id"]  = "required|numeric|exists:specifications,id";
        $ValidatorRules["nationality_id"]  = "required|numeric|exists:nationalities,id";
        $ValidatorRules["consulting_price"]  = "required|numeric";
        $ValidatorRules["salary"]  = "numeric";
        $ValidatorRules["services"]  = "required|array";
        return  $ValidatorRules;
    }
    public function store(Request $request)
    {
        $ValidatorRules = $this->getDoctorValidatorRules(null, true);
        $validator = Validator::make($request->all(), $ValidatorRules);
        if ($validator->fails()) {
            Flashy::error(trans('m.oops_error'));
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        try {
            DB::beginTransaction();
            try {
                $user =  $this->createUser($request);
                $doctor = Doctor::create([
                    'user_id' => $user->id,
                    "nickname_id" => $request->nickname_id,
                    "specification_id" => $request->specification_id,
                    "nationality_id" => $request->nationality_id,
                    "consulting_price" => $request->consulting_price,
                    "salary" => $request->salary,
                ]);
                if ($request->has('services'))
                    $doctor->services()->sync($request->input('services'));
                DB::commit();
                Flashy::success('تمت اضافة الطبيب بنجاح ');
                return redirect()->route('doctor.index');
            } catch (Exception $e) {
                DB::rollback();
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function update($id, Request $request)
    {


        $hasPassword = true;
        if (empty($request['password'])) {
            unset($request['password']);
            unset($request['confirm_password']);
            $hasPassword = false;
        }
        try {
            $doctor = Doctor::find($id);
            if ($doctor == null)
                return $this->getErrorView(trans('m.not_found'));




            $ValidatorRules = $this->getDoctorValidatorRules($doctor->user->id, $hasPassword);
            $validator = Validator::make($request->all(), $ValidatorRules);
            if ($validator->fails()) {
                Flashy::error(trans('m.oops_error'));
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            DB::beginTransaction();
            try {
                $this->updateUser($doctor->user_id, $request);
                $doctor->update([
                    "nickname_id" => $request->nickname_id,
                    "specification_id" => $request->specification_id,
                    "nationality_id" => $request->nationality_id,
                    "consulting_price" => $request->consulting_price,
                    "salary" => $request->salary,
                ]);

                if ($request->has('services'))
                    $doctor->services()->sync($request->input('services'));
              /*   $doctor->doctorTimes()->delete();
                $DoctorServices =   $doctor->services()->get();
                foreach ($DoctorServices as $service) {
                    $serviceTimes =   $service->serviceTimes()->get();
                    $working_days_data = $this->getDoctorWorkingDays($serviceTimes, $doctor->id);
                    if (count($working_days_data) > 0)
                        $doctor->doctorTimes()->insert($working_days_data);
                } */

                /*
                if (!is_array($working_days_data)) {
                    return redirect()->back()->with('workingDay', $working_days_data)->withInput($request->all());
                }

               */
                DB::commit();
                Flashy::success('تم تعديل الدكتور بنجاح');
                return redirect()->route('doctor.index');
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function destroy($id)
    {
        try {
            $doctor = Doctor::find($id);
            if ($doctor == null)
                return $this->getErrorView(trans('m.not_found'));
            if (!(count($doctor->services) > 0 || count($doctor->patients) > 0)) {
                $doctor->doctorTimes()->delete();
                $doctor->user()->delete();
                // $doctor->delete();
                Flashy::success(view_delete_succ('doctor'));
                return redirect()->route('doctor.index');
            } else {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->route('doctor.index');
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function changeStatus($id, $status)
    {
        try {
            $doctor = Doctor::find($id);
            if ($doctor == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $doctor->user()->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            //  return redirect()->route('doctor.index');
            return redirect()->back();
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    private function getDoctorTimesArray($times = null)
    {
        $dayKeys = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timesArray = [];
        $timesCount = ($times == null) ? 0 : count($times);
        $order = 1;
        foreach ($dayKeys as $dayName) {
            $hasDay = 0;
            if ($timesCount > 0)
                foreach ($times as $obj) {
                    if ($obj['day_name'] === $dayName) {
                        $timesArray[] = [
                            "id" => $obj['id'],
                            "day_title" => trans('messages.' . $dayName),
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
                    "day_title" => trans('messages.' . $dayName),
                    "day_name" => $dayName,

                    "order" => $order,
                    "start_time" => "09:00",
                    "end_time" => "12:00"
                ];
                $order++;
            }
        }
        return $timesArray;
    }
    public function getWorkingDays(Request $request, $doctorId = 0)
    {
        // working days
        $working_days_data = [];
        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $order = 1;
        foreach ($request->workingDay as $dayKey => $dayValues) {
            if (!in_array($dayKey, $days)) {
                Flashy::error('يوجد خطأ, الرجاء التأكد من إدخال جميع الحقول');
                return redirect()->back()->with('working_day', 'هذا اليوم غير صحيح او ربما يكون الفرق  بين من والي اقل من وقت الحجز المدخل اعلاه ')->withInput($request->all());
            }
            foreach ($dayValues as $dayIndex => $day) {
                $from = Carbon::parse($day['from']);
                $to = Carbon::parse($day['to']);
                if ($to->diffInMinutes($from) < $request->reservation_period) {
                    Flashy::error('يوجد خطأ, الرجاء التأكد من إدخال جميع الحقول');
                    return redirect()->back()->with('working_day', 'هذا اليوم غير صحيح او ربما يكون الفرق  بين من والي اقل من وقت الحجز المدخل اعلاه ')->withInput($request->all());
                }
                $working_days_data[] = [
                    'provider_id' => $request->provider_id,
                    'day_name' => $dayKey,

                    'start_time' => $from->format('H:i'),
                    'end_time' => $to->format('H:i'),
                    'order' => $order,
                    'doctor_id' => $doctorId,
                    'reservation_period' => $request->reservation_period
                ];
                $order++;
            }
        }
        return $working_days_data;
    }
    public function getDoctorDays()
    {
        //           هنا  انا بجيب ايام عمل الطبيب في الاسبوع وبعدين من الكالندر في الادمن هو بيبعتلي الشهر والسنه فبجيب كل الايام الي هو مش شغال فيها ع شبيل المثال الاحد والاتنثين و بنادي داله بتجبلي كل الاحد والاتنين الي ف الشهر ده بتواريخهم عشان اقدر اعرض هذه الايام طول الشهر انها غير متاحه علي الكاليندر في الادمن في صفحه تعديل موعد حجز
        $doctor_id = Session::has('doctor_id_for_Edit_reserv') ? Session::get('doctor_id_for_Edit_reserv') : 0;
        $doctor_days = DB::table('doctor_times')->where('doctor_id', $doctor_id)->pluck('day_name')->toArray();
        $week_days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $unavailble_days = array_values(array_diff($week_days, $doctor_days));
        $month_days = $this->get_dates(\request()->month, \request()->year);
        $unavailble_day_dates = [];
        if (!empty($unavailble_days) && count($unavailble_days) > 0) {
            $unavailble_day_dates = $this->unavailabledate($month_days, $unavailble_days);
        }
        return response()->json(json_decode(json_encode($unavailble_day_dates)));
    }
    protected function get_dates($month, $year)
    {
        $start_date = "01-" . $month . "-" . $year;
        $start_time = strtotime($start_date);
        $end_time = strtotime("+1 month", $start_time);
        $index = 0;
        for ($i = $start_time; $i < $end_time; $i += 86400) {
            $name = date("l", $i);
            $list[$index]['day_name'] = strtolower($name);
            $list[$index]['date'] = date('Y-m-d', $i);
            $index++;
        }
        return $list;
    }
    public function unavailabledate($month_days, $unavailble_days)
    {
        $unavaibledates = [];
        $index = 0;
        foreach ($unavailble_days as $dayName) {
            foreach ($month_days as $index => $monthDay) {
                if ($monthDay['day_name'] == $dayName) {
                    $unavaibledates[$index]['day_name'] = $monthDay['day_name'];
                    $unavaibledates[$index]['date'] = $monthDay['date'];
                    $unavaibledates[$index]['classname'] = 'dangerc';
                }
                $index++;
            }
        }
        return array_values($unavaibledates);
    }
    // api
    public function AddShiftTime(Request $request)
    {
        $requestData = $request->all();
        $data['counter'] = $request->counter;
        $data['day_ar'] = $request->day_ar;
        $data['day_en'] = $request->day_en;
        $view = view('doctor.addShiftTimes', $data)->render();
        return response()->json([
            'content' => $view,
            'requestData' => $requestData
        ]);
    }
    public function removeShiftTimes(Request $request)
    {
        $id = $request->id;
        $time = DoctorTime::findorfail($id);
        $time->delete();
        return response()->json([]);
    }
}

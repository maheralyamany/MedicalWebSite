<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use App\Models\Appointments;
use App\Models\DoctorService;
use App\Models\Service;
use App\Traits\AppointmentsTrait;
use App\Traits\Dashboard\PublicTrait;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    use PublicTrait, UploadFiles, AppointmentsTrait;
    public static function getDataByQueryStr($queryStr)
    {
        $patients = Patient::with('appointments')
            ->where('patientname', 'LIKE', '%' . trim($queryStr) . '%')
            ->orWhere('mobile', 'LIKE', '%' . trim($queryStr) . '%')
            ->orWhere('address', 'LIKE', '%' . trim($queryStr) . '%')
            ->orderBy('id', 'DESC')
            ->paginate(PAGINATION_COUNT);
        return view('patients.index', compact('patients'));
    }
    /*   public  function search(Request $request)
    {
        $queryStr = $request->queryStr;
        try {
            $patients = DB::table('patients')
                ->join('cities', 'patients.city_id', '=', 'cities.id')
                ->where('patients.patientname', 'LIKE', '%' . trim($queryStr) . '%')
                ->select(
                    'patients.id',
                    'patients.patientname',
                    'patients.photo',
                    DB::raw('cities.name_' . app()->getLocale() . ' as city_name'),
                    'patients.address',
                    DB::raw("CONCAT('" . url(app()->getLocale()) . "/patients/', patients.id,'/edit') AS route")
                )
                ->orderBy('patients.patientname', 'ASC')
                ->get();
            return response()->json($patients);
        } catch (\Throwable $th) {
            throw $th;
        }
    } */
    public  function search(Request $request)
    {
        $queryStr = $request->queryStr;
        try {
            $patients = Patient::with(['appointments'])->where('patientname', 'LIKE', '%' . trim($queryStr) . '%')->orderBy('patientname', 'ASC')
                ->get();
            $data['patients'] = $patients;
            $data['isSearch'] = true;
            $view = view('patients.patients_table', $data)->render();
            return response()->json([
                'content' => $view,
            ]);
            //return response()->json($patients);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // $patients = Patient::with(['appointments'])->paginate(PAGINATION_COUNT);
            $patients = Patient::with(['appointments'])->get();
            return view('patients.index', compact('patients'));
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\View\View
     */
    public function show(Patient $patient)
    {
        return view('patients.show', [
            'patient' => $patient
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = $this->getFormData();
        if ($data == null)
            return $this->getErrorView(trans('m.not_found'));
        return view('patients.create', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\View\View
     */
    public function edit(Patient $patient)
    {
        $data = $this->getFormData();
        if ($data == null)
            return $this->getErrorView(trans('m.not_found'));
        $data['patient'] = $patient;
        return view('patients.edit', $data);
    }
    public function getFormData()
    {
        try {
            $data = [];
            // $data['doctorServices'] = DoctorService::get(); services
            // $data['doctors'] = $this->getAllActiveDoctors();
            /*   $activities = Service::with([
                'doctors' => function (MorphTo $morphTo) {
                    $morphTo->morphWith([
                        Event::class => ['calendar'],
                        Photo::class => ['tags'],
                        Post::class => ['author'],
                    ]);
                }])->get(); */
            $data['services'] = Service::with(['doctors', 'doctors.user'])->whereHas('doctors', function ($q) {
                $q->Active();
            })->get();
            return $data;
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function store(Request $request)
    {
        $req = $request->all();
        /*  $validator = $this->validatePatient($request);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        } */
        try {
            $patient =   Patient::create([
                'patientname' =>  $request->input('patientname'),
                'email' => $request->input('email'),
                'mobile ' => $request->input('mobile'),
                'city_id' => $request->input('city_id'),
                'bloodgroup ' => $request->input('bloodgroup'),
                'age' => $request->input('age'),
                'address ' => $request->input('address'),
                'gender' => $request->input('gender'),
            ]);
            if ($patient) {
                if ($request->hasFile('photo')) {
                    $fileName = $this->uploadFile($request->file('photo'), 'patients');
                    $patient->update(['photo' => $fileName]);
                }
                $request->mergeIfMissing(['patient_id' => $patient->id]);
                $this->createAppointment($request);
                return response()->json([
                    'status' => true,
                    'msg' => view_add_succ('patients'),
                ]);
            }
            return response()->json([
                'status' => false,
                'msg' => trans('m.oops_error'),
            ]);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function update(Request $request)
    {
        try {
            $patient = Patient::find($request->id);
            if ($patient == null)
                return response()->json([
                    'status' => false,
                    'msg' => trans('m.not_found'),
                ]);
            $patient->update([
                'patientname' =>  $request->patientname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'city_id' => $request->city_id,
                'bloodgroup' => $request->bloodgroup,
                'age' => $request->age,
                'address' => $request->address,
                'gender' => $request->gender,
            ]);
            if ($patient->id > 0) {
                if ($request->hasFile('photo')) {
                    $fileName = $this->uploadFile($request->file('photo'), 'patients', $patient->photo);
                    $patient->update(['photo' => $fileName]);
                }
                $request->mergeIfMissing(['patient_id' => $patient->id]);
                $this->createAppointment($request);
                return response()->json([
                    'status' => true,
                    'msg' => view_edit_succ('patients'),
                ]);
            }
            return response()->json([
                'status' => false,
                'msg' => trans('m.oops_error'),
            ]);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\View\View
     */
    public function destroy(Patient $patient)
    {
        try {
            if ($patient == null)
                return $this->getErrorView(trans('m.not_found'));
            if (count($patient->appointments) == 0) {
                $patient->delete();
                Flashy::success(view_delete_succ('patients'));
                return redirect()->route('patients.index');
            } else {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->route('patients.index');
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

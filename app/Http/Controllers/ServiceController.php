<?php
namespace App\Http\Controllers;
use App\Http\Requests\ServiceRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceTime;
use App\Traits\WorkTimeTrait;
use App\Utilities\MLaratables;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
class ServiceController extends Controller
{
    use WorkTimeTrait;
    public function index()
    {
        try {
            $data = [];
            $queryStr = '';
            if (request('queryStr')) {
                $queryStr = request('queryStr');
                $data['services'] = Service::with(['appointments','doctors','serviceTimes','department'])->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(PAGINATION_COUNT);
            } elseif (request('generalQueryStr')) {  //search all column
                $q = request('generalQueryStr');
                $data['services'] = Service::with(['appointments','doctors','serviceTimes','department'])->where('name_ar', 'LIKE', '%' . trim($q) . '%')
                    ->orWhere(function ($qq) use ($q) {
                        if (trim($q) ==trans('m.actived')) {
                            $qq->Active();
                        } elseif (trim($q) == trans('m.un_actived')) {
                            $qq->UnActive();
                        }
                    })
                    ->orWhere('name_en', 'LIKE', '%' . trim($q) . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(PAGINATION_COUNT);
            } else
                $data['services'] = Service::with(['appointments','doctors','serviceTimes','department'])->paginate(PAGINATION_COUNT);
            return view('services.index', $data);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function show(Service $service)
    {
        return view('services.view', [
            'service' => $service
        ]);
    }
    public function create()
    {
        $data=$this->getFormData();
        return view('services.create',  $data);
    }
    public function edit(Service $service)
    {
        $data=$this->getFormData($service);
        return view('services.edit', $data);
    }
    public function getFormData(Service $service = null)
    {
        try {
            $times =null;
            if ($service != null) {
                $data['item'] = $service;
                $times = $service->serviceTimes()->get();
            }
            $data['times'] = $this->getWorkTimesArray($times);
            $data['departments'] = Department::pluck('name_ar', 'id');
            return $data;
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
   
  
    public function store(Service $service, ServiceRequest $request)
    {
        $working_days_data = $this->getWorkingDays($request);
        if(!is_array($working_days_data)){
            return redirect()->back()->with('workingDay',$working_days_data)->withInput($request->all());
        }
        DB::beginTransaction();
        try {
            $service =   $service->create([
                'service_name' =>  $request->service_name,
                'department_id' => $request->department_id,
                'has_price' => $request->has_price,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            if ($service->id > 0) {
                for ($i = 0; $i < count($working_days_data); $i++) {
                    $dayData = $working_days_data[$i];
                    $dayData['service_id'] = $service->id;
                    $working_days_data[$i] = $dayData;
                }
                $service->serviceTimes()->insert($working_days_data);
                DB::commit();
                Flashy::success(trans('m.item_added_succ'));
                return redirect()->route('services.index');
            }
            DB::rollback();
            Flashy::error(trans('m.oops_error'));
            return redirect()->back()->with('errors',['error'=>$service->id])->withInput($request->all());
        } catch (Exception $ex) {
            DB::rollback();
            return $this->getViewException($ex);
        }
    }
    public function update(Service $service, ServiceRequest $request)
    {
        $working_days_data = $this->getWorkingDays($request);
        if(!is_array($working_days_data)){
            return redirect()->back()->with('workingDay',$working_days_data)->withInput($request->all());
        }
        DB::beginTransaction();
        try {
            $service->update([
                'service_name' =>  $request->service_name,
                'department_id' => $request->department_id,
                'has_price' => $request->has_price,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            $service->serviceTimes()->delete();
            $service->serviceTimes()->insert($working_days_data);
            DB::commit();
            Flashy::success(trans('m.item_updated_succ'));
            return redirect()->route('services.index');
        } catch (Exception $ex) {
            DB::rollback();
            return $this->getViewException($ex);
        }
    }
    public function destroy(Service $service)
    {
        try {
            if ($service == null) {
                Flashy::error(trans('m.not_found'));
                return redirect()->back();
            }
            if (count($service->serviceTimes) > 0||count($service->doctors) > 0||count($service->appointments) > 0) {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->back();
            }
            $service->delete();
            Flashy::success(trans('m.item_deleted_succ'));
            return redirect()->back();
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function changeStatus($id, $status)
    {
        try {
            $service = Service::find($id);
            if ($service == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $service->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->route('services.index');
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

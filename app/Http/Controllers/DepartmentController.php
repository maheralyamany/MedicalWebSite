<?php
namespace App\Http\Controllers;
use App\Http\Requests\DepartmentRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Utilities\MLaratables;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
class DepartmentController extends Controller
{
   
    public function index()
    {
        try {
            $data = [];
            $queryStr = '';
            if (request('queryStr')) {
                $queryStr = request('queryStr');
                $data['departments'] = Department::with('services')->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(PAGINATION_COUNT);
            } elseif (request('generalQueryStr')) {  //search all column
                $q = request('generalQueryStr');
                $data['departments'] = Department::with('services')->where('name_ar', 'LIKE', '%' . trim($q) . '%')
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
                $data['departments'] = Department::with('services')->paginate(PAGINATION_COUNT);
            return view('departments.index', $data);
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function show(Department $department)
    {
        return view('departments.view', [
            'department' => $department
        ]);
    }
    public function create()
    {
        return view('departments.create', [
            'branches' => Branch::pluck('name_ar', 'id')
        ]);
    }
    public function store(Department $department, DepartmentRequest $request)
    {
        try {
            $department =   $department->create([
                'name_en' =>  $request->name_en,
                'name_ar' => $request->name_ar,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
            ]);
            if ($department->id > 0) {
                Flashy::success(trans('m.item_added_succ'));
                return redirect()->route('departments.index');
            }
            Flashy::error(trans('m.oops_error'));
            return redirect()->back()->withErrors($request->errors()->all())->withInput($request->all());
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function edit(Department $department)
    {
        return view('departments.edit', [
            'item' => $department,
            'branches' => Branch::pluck('name_ar', 'id')
        ]);
    }
    public function update(Department $department, DepartmentRequest $request)
    {
        try {
            $department->update([
                'name_en' =>  $request->name_en,
                'name_ar' => $request->name_ar,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
            ]);
            Flashy::success(trans('m.item_updated_succ'));
            return redirect()->route('departments.index');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    public function destroy(Department $department)
    {
        try {
            if ($department == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if (count($department->services) > 0) {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->back();
            }
            $department->delete();
            Flashy::success(trans('m.item_deleted_succ'));
            return redirect()->back();
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function changeStatus($id, $status)
    {
        try {
            $department = Department::find($id);
            if ($department == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $department->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->route('departments.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

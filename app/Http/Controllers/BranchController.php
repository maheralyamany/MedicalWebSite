<?php
namespace App\Http\Controllers;
use App\Traits\Dashboard\BranchTrait;
use App\Traits\Dashboard\PublicTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRequest;
use App\Models\Branch;
use App\Models\User;
use App\Traits\UploadFiles;
use App\Utilities\BranchDataSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use MercurySeries\Flashy\Flashy;
class BranchController extends Controller
{
    use PublicTrait, UploadFiles, BranchTrait;
    public function getDataTable()
    {
        try {
            $queryStr = request('queryStr');
            return $this->getAllBranches($queryStr);
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public static function getDataByQueryStr($queryStr)
    {
        $branches = Branch::with(['departments','users'])
            ->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')
            ->orWhere('name_en', 'LIKE', '%' . trim($queryStr) . '%')
            ->orderBy('id', 'DESC')
            ->paginate(PAGINATION_COUNT);
        return view('branch.index', compact('branches'));
    }
    public function index()
    {
        try {
            $branches = Branch::with('departments')->paginate(PAGINATION_COUNT);
            return view('branch.index', compact('branches'));
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function show(Branch $branch)
    {
        return view('branch.view', [
            'branch' => $branch
        ]);
    }
    public function create()
    {
        return view('branch.create');
    }
    public function store(Branch $branch, StoreBranchRequest $request)
    {
        try {
            $branch =   $branch->create([
                'name_en' =>  $request->name_en,
                'name_ar' => $request->name_ar,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'status' => $request->status,
                'working_days' => json_encode($request->branch_days),
            ]);
            if ($branch->id > 0) {
                if ($request->hasFile('logo')) {
                    $fileName = $this->uploadFile($request->file('logo'), 'branches');
                    $branch->update(['logo' => $fileName]);
                }
                Flashy::success(view_add_succ('branch'));
                return redirect()->route('branch.index');
            }
            Flashy::error(trans('m.oops_error'));
            return redirect()->back()->withErrors($request->errors()->all())->withInput($request->all());
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function edit(Branch $branch)
    {
        return view('branch.edit', [
            'branch' => $branch
        ]);
    }
    public function update(Branch $branch, StoreBranchRequest $request)
    {
        try {
            $fileName = '';
            $branch->update([
                'name_en' =>  $request->name_en,
                'name_ar' => $request->name_ar,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'status' => $request->status,
                'working_days' => json_encode($request->branch_days),
            ]);
            if ($request->hasFile('logo')) {
                //  return $request->file('logo');
                $fileName = $this->uploadFile($request->file('logo'), 'branches', $fileName);
            }
            BranchDataSession::clear();
            $branch->update(['logo' => $fileName]);
            Flashy::success(trans('m.item_updated_succ'));
            return redirect()->route('branch.index');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    public function destroy(Branch $branch)
    {
        try {
            if ($branch == null) {
                Flashy::error(trans('m.not_found'));
                return redirect()->back();
            }
            if (count($branch->departments) > 0||count($branch->users) > 0) {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->back();
            }
            $branch->delete();
            Flashy::success(trans('m.item_deleted_succ'));
            return redirect()->back();
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function changeStatus($id, $status)
    {
        try {
            $branch = $this->getBranchById($id);
            if ($branch == null) {
                Flashy::error(trans('m.not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $branch->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->route('branch.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function changeStatusAjax(Request $request)
    {
        $req = $request->all();
        $res = [
            'id' => $req['id'],
            'status' => true,
            'msg' =>  trans('m.status_changed_succ'),
        ];
        try {
            $branch = $this->getBranchById($req['id']);
            if ($branch == null) {
                $res['msg'] = trans('m.not_found');
                $res['status'] = false;
            }
            if ($res['status'] == true) {
                if ($req['status'] != 0 && $req['status'] != 1) {
                    $res['msg'] = trans('m.non_status');
                    $res['status'] = false;
                } else {
                    $branch->update(['status' => $req['status']]);

                }
            }
        } catch (\Exception $ex) {
            $res['msg'] = trans('m.status_changed_error');
            $res['status'] = false;
        }
        return response()->json($res);
    }
}

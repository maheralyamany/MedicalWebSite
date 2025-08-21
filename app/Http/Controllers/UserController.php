<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Traits\Dashboard\UserTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CardType;

use App\Models\Role;

use App\Models\UsersGroup;
use App\Traits\Dashboard\PublicTrait;
use App\Traits\UploadFiles;
use Exception;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use UserTrait, PublicTrait;
    public function getDataTable()
    {
        //laratables//
        try {
            $queryStr = request('queryStr');
            return $this->getAllUsers($queryStr);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public static function getDataByQueryStr($queryStr)
    {
        $data = [];
        $data['users'] = User::with('branch')->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')->orWhere('name_en', 'LIKE', '%' . trim($queryStr) . '%')
            ->orderBy('id', 'ASC')
            ->paginate(PAGINATION_COUNT);
        return view('user.index', $data);
    }
    public function index()
    {
        // not lara tables
        $data = [];
        $data['users'] = User::with('branch')->orderBy('id', 'ASC')->paginate(PAGINATION_COUNT);
        return view('user.index', $data);
    }

    public function view($id)
    {
        try {
            $user = User::with('branch')->find($id);
            if ($user == null)
                return $this->getErrorView(trans('m.not_found'));

            return view('user.view', compact('user'));
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->getUserById($id);
            if ($user == null)
                return $this->getErrorView(trans('m.not_found'));
            if ($user->has('doctor')) {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->back();
            } else {
                $user->delete();
                Flashy::success(trans('m.item_deleted_succ'));
                return redirect()->back();
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function changeStatus($id, $status)
    {
        try {
            $user = $this->getUserById($id);
            if ($user == null)
                return $this->getErrorView(trans('m.not_found'));
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $this->changerUserStatus($user, $status);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->back();
        } catch (Exception $ex) {
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
            $user = $this->getUserById($req['id']);
            if ($user == null) {
                $res['msg'] = trans('m.not_found');
                $res['status'] = false;
            }
            if ($res['status'] == true) {
                if ($req['status'] != 0 && $req['status'] != 1) {
                    $res['msg'] = trans('m.non_status');
                    $res['status'] = false;
                } else {
                    $this->changerUserStatus($user, $req['status']);
                }
            }
        } catch (Exception $ex) {
            $res['msg'] = trans('m.status_changed_error');
            $res['status'] = false;
        }
        return response()->json($res);
    }
    public function editUser($id)
    {
        try {
            $data = $this->viewUser($id);
            return view('user.edit', $data);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function addUser()
    {
        try {
            $data = $this->viewUser();
            return view('user.create', $data);
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function viewUser($id = null)
    {
        try {
            $data = [];
            $user = (isset($id)) ? User::where('id', $id)->with(['roles', 'permissions', 'doctor'])->first() : null;
            if (isset($id) && $user == null)
                return $this->getErrorView(trans('m.not_found'));
            if ($user != null)
                $data['user'] = $user;
            $data['roles'] = Role::with('permissions')->orderBy('id')->get();
            $data['usersType'] = UsersGroup::pluck('name', 'id');
            $data['cardTypes'] = CardType::pluck('name_ar', 'id');
            $data['branches'] = $this->getBranchesList();
            $data['genders'] = ['male' => trans('m.male'), 'female' => trans('m.female')];
            return $data;
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    public function storeUser(Request $request)
    {
        //  return    $request->input('userPermission');
        try {
            $ValidatorRules = $this->getUserValidatorRules(null, true);
            $validator = Validator::make($request->all(), $ValidatorRules);
            if ($validator->fails()) {
                Flashy::error(trans('m.oops_error'));
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }


            DB::beginTransaction();
            try {
                $this->createUser($request);
                DB::commit();
                Flashy::success(view_add_succ('users'));
                return redirect()->route('users.index');
            } catch (Exception $ex) {
                DB::rollback();
                Flashy::error($ex->getMessage());
                return redirect()->back()->with("user-error", $ex->getMessage())->withInput($request->all());
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
            $ValidatorRules = $this->getUserValidatorRules($id, $hasPassword);
            $validator = Validator::make($request->all(), $ValidatorRules);
            if ($validator->fails()) {
                Flashy::error(trans('m.oops_error'));
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            DB::beginTransaction();
            try {

                $this->updateUser($id, $request);

                DB::commit();
                Flashy::success(view_edit_succ('users'));
                return redirect()->route('users.index');
            } catch (Exception $ex) {
                DB::rollback();
                Flashy::error($ex->getMessage());
                return redirect()->back()->with("user-error", $ex->getMessage())->withInput($request->all());
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

<?php

namespace App\Traits\Dashboard;


use App\Models\Branch;

use App\Models\User;

use App\Traits\UploadFiles;
use App\Utilities\MLaratables;
use Illuminate\Http\Request;

trait UserTrait
{
    use UploadFiles;
    public function getUserById($id)
    {
        return User::find($id);
    }


    public function getAllUsers($queryStr)
    {
        return MLaratables::recordsOf(User::class, function ($query) use ($queryStr) {
            return $query->where(function ($q) use ($queryStr) {
                return $q->where('name_ar', 'LIKE', '%' . trim($queryStr) . '%')->orWhere('name_en', 'LIKE', '%' . trim($queryStr) . '%');
            });
        });
    }
    public function changerUserStatus($user, $status)
    {
        $user = $user->update([
            'status' => $status
        ]);
        return $user;
    }
    public function checkIfMobileUsed($phone_no, $id)
    {
        $exists = User::where('phone_no', $phone_no)->first();
        if ($exists)
            return $exists->id != $id;
        return false;
    }
    public function createUser(Request $request)
    {
        $fileName = "";
        if ($request->hasFile('photo')) {
            $fileName = $this->uploadFile($request->file('photo'), 'users');
        }

        $user = User::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'password' => $request->password,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'gender' => $request->gender,
            'photo' => $fileName,
            'status' => $request->status,
            'address' => $request->address,
            'birth_date' => $request->birth_date ? $request->birth_date : null,
            'id_card' => $request->id_card ? $request->id_card : null,
            'card_type_id' => $request->card_type_id,
            'group_id' => $request->group_id,
            'branch_id' => $request->branch_id,
        ]);
        if ($request->has('userRole') && !empty($request->input('userRole')))
            $user->roles()->sync($request->input('userRole'));
        if ($request->has('userPermission') && !empty($request->input('userPermission')))
            $user->permissions()->sync($request->input('userPermission'));
        return $user;
    }
    public function updateUser($user_id,Request $request)
    {
        $user = User::find($user_id);
        $fileName = "";
        if ($request->hasFile('photo')) {
            $fileName = $this->uploadFile($request->file('photo'), 'users', $user->photo);
        }

        $user->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'password' => ($request->has('password')) ? $request->password : $user->password,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'gender' => $request->gender,
            'photo' => $fileName,
            'status' => $request->status,
            'address' => $request->address,
            'birth_date' => $request->birth_date ? $request->birth_date : null,
            'id_card' => $request->id_card ? $request->id_card : null,
            'card_type_id' => $request->card_type_id,
            'group_id' => $request->group_id,
            'branch_id' => $request->branch_id,
        ]);
        if ($request->has('userRole') && !empty($request->input('userRole')))
            $user->roles()->sync($request->input('userRole'));
        if ($request->has('userPermission') && !empty($request->input('userPermission')))
            $user->permissions()->sync($request->input('userPermission'));
        return $user;
    }
    public  function getUserValidatorRules($id, $hasPassword)
    {

        $unique = 'unique:users,phone_no,' . $id;

        $roules = [
            'name_ar' =>  "required|max:255",
            'name_en' =>   "sometimes|nullable|max:255",
            "gender" => "required",
            "phone_no" => array(
                "required",
                "numeric",
                $unique,
                "digits_between:9,14",
                "regex:/^(009667|9667|\+9667|77|73|71|70)([0-9]{7})$/"
            ),

            'email' => 'sometimes|nullable|email',

            "status" => "required|in:0,1",
            "group_id" => "required",
            "branch_id" => "required|numeric|exists:branches,id",
        ];
        if ($hasPassword || (!(isset($id) && $id != null &&   intval($id) != 0 && !empty($id))))
            $roules['password'] = 'required|same:confirm_password|max:255';
        return $roules;
    }
}

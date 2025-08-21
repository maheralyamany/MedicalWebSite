<?php

namespace App\Http\Controllers;

use App\Traits\Dashboard\NicknameTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nickname;
use Illuminate\Support\Facades\Validator;
use MercurySeries\Flashy\Flashy;

class NicknameController extends Controller
{
    use NicknameTrait;

    public function getDataTable(){
        try{
            return $this->getAllNicknames();
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function index(){

        $data['nicknames'] = Nickname::with('doctors')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('nickname.index', $data);
       
    }

    public function add(){
        return view('nickname.add');
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                "name_en" => "required|max:255",
                "name_ar" => "required|max:255",
            ]);
            if ($validator->fails()) {
                Flashy::error('يوجد خطأ, الرجاء التأكد من إدخال جميع الحقول');
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            $this->createNickname($request);
            Flashy::success('تم إضافة اللقب بنجاح');
            return redirect()->route('nickname.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function edit($id){
        try{
            $nickname = $this->getNicknameById($id);
            if($nickname == null)
                 return $this->getErrorView(trans('m.not_found'));

            return view('nickname.edit', compact('nickname'));
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function update($id, Request $request){
        try{
            $validator = Validator::make($request->all(), [
                "name_en" => "required|max:255",
                "name_ar" => "required|max:255",
            ]);
            if ($validator->fails()) {
                Flashy::error('يوجد خطأ, الرجاء التأكد من إدخال جميع الحقول');
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            $nickname = $this->getNicknameById($id);
            if($nickname == null)
                 return $this->getErrorView(trans('m.not_found'));

            $this->updateNickname($nickname, $request);
            Flashy::success('تم تعديل اللقب بنجاح');
            return redirect()->route('nickname.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function destroy($id){
        try{
            $nickname = $this->getNicknameById($id);
            if($nickname == null)
                 return $this->getErrorView(trans('m.not_found'));

            if(count($nickname->doctors) == 0){
                $nickname->delete();
                Flashy::success('تم مسح اللقب بنجاح');
            } else {
                Flashy::error('لا يمكن مسح لقب مرتبط بدكاترة');
            }
            return redirect()->route('nickname.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

}

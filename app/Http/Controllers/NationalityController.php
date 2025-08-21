<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nationality;
use App\Traits\Dashboard\NationalityTrait;
use Illuminate\Support\Facades\Validator;
use MercurySeries\Flashy\Flashy;

class NationalityController extends Controller
{
    use NationalityTrait;

    public function getDataTable(){
        try{
            return $this->getAll();
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function index(){

     $nationalities=   Nationality::with('doctors')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        return view('nationality.index',compact('nationalities'));
    }

    public function add(){
        return view('nationality.add');
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                "name_en" => "required|max:255",
                "name_ar" => "required|max:255"
            ]);
            if ($validator->fails()) {
                Flashy::error('يوجد خطأ, الرجاء التأكد من إدخال جميع الحقول');
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            $this->createNationality($request);
            Flashy::success('تم إضافة الجنسية بنجاح');
            return redirect()->route('nationality.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function edit($id){
        try{
            $nationality = $this->getNationalityById($id);
            if($nationality == null)
                 return $this->getErrorView(trans('m.not_found'));

            return view('nationality.edit', compact('nationality'));
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function update($id, Request $request){
        try{
            $validator = Validator::make($request->all(), [
                "name_en" => "required|max:255",
                "name_ar" => "required|max:255"
            ]);
            if ($validator->fails()) {
                Flashy::error('يوجد خطأ, الرجاء التأكد من إدخال جميع الحقول');
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            $nationality = $this->getNationalityById($id);
            if($nationality == null)
                 return $this->getErrorView(trans('m.not_found'));

            $this->updateNationality($nationality, $request);
            Flashy::success('تم تعديل الجنسية بنجاح');
            return redirect()->route('nationality.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function destroy($id){
        try{
            $nationality = $this->getNationalityById($id);
            if($nationality == null)
                 return $this->getErrorView(trans('m.not_found'));

            if(count($nationality->doctors) == 0){
                $nationality->delete();
                Flashy::success('تم مسح الجنسيه بنجاح');
            } else {
                Flashy::error('لا يمكن مسح جنسية مرتبطه بدكاترة');
            }
            return redirect()->route('nationality.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

}

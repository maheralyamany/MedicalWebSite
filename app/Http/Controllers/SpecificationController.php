<?php

namespace App\Http\Controllers;

use App\Traits\Dashboard\SpecificationTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specification;
use Illuminate\Support\Facades\Validator;
use MercurySeries\Flashy\Flashy;

class SpecificationController extends Controller
{
    use SpecificationTrait;

    public function getDataTable(){
        try{
            return $this->getAllSpecifications();
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function index(){
        $data = [];
        $data['specifications'] = Specification::with('doctors')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('specification.index', $data);
      
    }

    public function add(){
        return view('specification.add');
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
            $this->createSpecification($request);
            Flashy::success('تم إضافة التخصص بنجاح');
            return redirect()->route('specification.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function edit($id){
        try{
            $specification = $this->getSpecificationById($id);
            if($specification == null)
                 return $this->getErrorView(trans('m.not_found'));

            return view('specification.edit', compact('specification'));
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
            $specification = $this->getSpecificationById($id);
            if($specification == null)
                 return $this->getErrorView(trans('m.not_found'));

            $this->updateSpecification($specification, $request);
            Flashy::success('تم تعديل التخصص بنجاح');
            return redirect()->route('specification.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function destroy($id){
        try{
            $specification = $this->getSpecificationById($id);
            if($specification == null)
                 return $this->getErrorView(trans('m.not_found'));

            if(count($specification->doctors) == 0){
                $specification->delete();
                Flashy::success('تم مسح التخصص بنجاح');
            } else {
                Flashy::error('لا يمكن مسح تخصص مرتبط بدكاترة');
            }
            return redirect()->route('specification.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

}

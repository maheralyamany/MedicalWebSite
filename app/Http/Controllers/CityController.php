<?php

namespace App\Http\Controllers;

use App\Traits\Dashboard\CityTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use MercurySeries\Flashy\Flashy;

class CityController extends Controller
{
    use CityTrait;

    public function getDataTable(){
        try{
            return $this->getAll();
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function index(){
        
        $data['citys'] = City::with('patients')->paginate(PAGINATION_COUNT);
        return view('city.index', $data);
       
    }

    public function add(){
        return view('city.add');
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
            $this->createCity($request);
            Flashy::success(trans('m.city.added_succ'));
            return redirect()->route('city.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function edit($id){
        try{
            $city = $this->getCityById($id);
            if($city == null)
            return $this->getErrorView(trans('m.not_found'));

            return view('city.edit', compact('city'));
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
            $city = $this->getCityById($id);
            if($city == null)
            return $this->getErrorView(trans('m.not_found'));

            $this->updateCity($city, $request);
            Flashy::success(trans('m.city.updated_succ'));
            return redirect()->route('city.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

    public function destroy($id){
        try{
            $city = $this->getCityById($id);
            if($city == null)
            return $this->getErrorView(trans('m.not_found'));

            if(count($city->providers) == 0){
                $city->delete();
                Flashy::success(trans('m.city.deleted_succ'));
              
            } else {
                Flashy::error(trans('m.city.has_chiled_error'));
            }
            return redirect()->route('city.index');
        } catch (\Exception $ex) {
            return $this->getViewException($ex);
        }
    }

}

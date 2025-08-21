<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrugRequest;
use App\Models\Drug;
use App\Models\DrugType;
use App\Models\Service;
use App\Traits\Dashboard\PublicTrait;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class DrugsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $drugs = Drug::with(['prescriptions','drugType'])->paginate(PAGINATION_COUNT);
            return view('drugs.index', compact('drugs'));
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\View\View
     */
    public function show(Drug $drug)
    {
        return view('drugs.show', [
            'drug' => $drug
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
        return view('drugs.create', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\View\View
     */
    public function edit(Drug $drug)
    {
        $data = $this->getFormData();
        if ($data == null)
            return $this->getErrorView(trans('m.not_found'));
        $data['drug'] = $drug;
        return view('drugs.edit', $data);
    }
    public function getFormData()
    {
        $data = [];
        $data['drugTypes'] = DrugType::select('id', DB::raw('name_' . app()->getLocale() . ' as name'))->get()->pluck('name', 'id');
        return $data;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugRequest  $request
     * @return \Illuminate\View\View
     */
    public function store(DrugRequest $request)
    {
        try {
            $drug =   Drug::create([
                'name_ar' =>  $request->name_ar,
                'name_en' => $request->name_en,
                'description' => $request->description,
                'type_id' => $request->type_id,
                'status' => $request->status,
              
            ]);
            if ($drug->id > 0) {
               
                Flashy::success(view_add_succ('drugs'));
                return redirect()->route('drugs.index');
            }
            Flashy::error(trans('m.oops_error'));
            return redirect()->back()->withErrors($request->errors()->all())->withInput($request->all());
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DrugRequest  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\View\View
     */
    public function update(DrugRequest $request, Drug $drug)
    {
        try {
            $drug->update([
                'name_ar' =>  $request->name_ar,
                'name_en' => $request->name_en,
                'description' => $request->description,
                'type_id' => $request->type_id,
                'status' => $request->status,
            ]);
            if ($drug->id > 0) {
               
                Flashy::success(view_edit_succ('drugs'));
                return redirect()->route('drugs.index');
            }
            Flashy::error(trans('m.oops_error'));
            return redirect()->back()->withErrors($request->errors()->all())->withInput($request->all());
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\View\View
     */
    public function destroy(Drug $drug)
    {
        try {
            if ($drug == null)
                return $this->getErrorView(trans('m.not_found'));
            if (count($drug->prescriptions) == 0) {
                $drug->delete();
                Flashy::success(view_delete_succ('drugs'));
                return redirect()->route('drugs.index');
            } else {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->route('drugs.index');
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
     public function changeStatus($id, $status)
    {
        try {
            $drug = Drug::find($id);
            if ($drug == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $drug->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->route('drugs.index');
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

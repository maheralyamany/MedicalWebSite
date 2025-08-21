<?php
namespace App\Http\Controllers;
use App\Http\Requests\XrayRequest;
use App\Models\Xray;
use Exception;
use MercurySeries\Flashy\Flashy;
class XrayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $xrays = Xray::with(['patientXrays'])->paginate(PAGINATION_COUNT);
            return view('xrays.index', compact('xrays'));
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\View\View
     */
    public function show(Xray $xray)
    {
        return view('xrays.show', [
            'xray' => $xray
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('xrays.create');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\View\View
     */
    public function edit(Xray $xray)
    {
        return view('xrays.edit',compact('xray'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\XrayRequest  $request
     * @return \Illuminate\View\View
     */
    public function store(XrayRequest $request)
    {
        try {
            $xray =   Xray::create([
                'name_ar' =>  $request->name_ar,
                'name_en' => $request->name_en,
                'xray_time' => $request->xray_time,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            if ($xray->id > 0) {
                Flashy::success(view_add_succ('xrays'));
                return redirect()->route('xrays.index');
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
     * @param  \App\Http\Requests\XrayRequest  $request
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\View\View
     */
    public function update(XrayRequest $request, Xray $xray)
    {
        try {
            $xray->update([
                'name_ar' =>  $request->name_ar,
                'name_en' => $request->name_en,
                'xray_time' => $request->xray_time,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            if ($xray->id > 0) {
                Flashy::success(view_edit_succ('xrays'));
                return redirect()->route('xrays.index');
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
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\View\View
     */
    public function destroy(Xray $xray)
    {
        try {
            if ($xray == null)
                return $this->getErrorView(trans('m.not_found'));
            if (count($xray->patientXrays) == 0) {
                $xray->delete();
                Flashy::success(view_delete_succ('xrays'));
                return redirect()->route('xrays.index');
            } else {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->route('xrays.index');
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
     public function changeStatus($id, $status)
    {
        try {
            $xray = Xray::find($id);
            if ($xray == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $xray->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->route('xrays.index');
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

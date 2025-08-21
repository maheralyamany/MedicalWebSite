<?php
namespace App\Http\Controllers;
use App\Http\Requests\LabTestRequest;
use App\Models\LabTest;
use Exception;
use MercurySeries\Flashy\Flashy;
class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $lab_tests = LabTest::with(['patientTests'])->paginate(PAGINATION_COUNT);
            return view('lab_tests.index', compact('lab_tests'));
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabTest  $lab_test
     * @return \Illuminate\View\View
     */
    public function show(LabTest $lab_test)
    {
        return view('lab_tests.show', [
            'lab_test' => $lab_test
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('lab_tests.create');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LabTest  $lab_test
     * @return \Illuminate\View\View
     */
    public function edit(LabTest $lab_test)
    {
        return view('lab_tests.edit',compact('lab_test'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LabTestRequest  $request
     * @return \Illuminate\View\View
     */
    public function store(LabTestRequest $request)
    {
        try {
            $lab_test =   LabTest::create([
                'name_ar' =>  $request->name_ar,
                'name_en' => $request->name_en,
                'test_time' => $request->test_time,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            if ($lab_test->id > 0) {
                Flashy::success(view_add_succ('lab_tests'));
                return redirect()->route('lab_tests.index');
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
     * @param  \App\Http\Requests\LabTestRequest  $request
     * @param  \App\Models\LabTest  $lab_test
     * @return \Illuminate\View\View
     */
    public function update(LabTestRequest $request, LabTest $lab_test)
    {
        try {
            $lab_test->update([
                'name_ar' =>  $request->name_ar,
                'name_en' => $request->name_en,
                'test_time' => $request->test_time,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            if ($lab_test->id > 0) {
                Flashy::success(view_edit_succ('lab_tests'));
                return redirect()->route('lab_tests.index');
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
     * @param  \App\Models\LabTest  $lab_test
     * @return \Illuminate\View\View
     */
    public function destroy(LabTest $lab_test)
    {
        try {
            if ($lab_test == null)
                return $this->getErrorView(trans('m.not_found'));
            if (count($lab_test->patientTests) == 0) {
                $lab_test->delete();
                Flashy::success(view_delete_succ('lab_tests'));
                return redirect()->route('lab_tests.index');
            } else {
                Flashy::error(trans('m.item_deleted_has_mov'));
                return redirect()->route('lab_tests.index');
            }
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
     public function changeStatus($id, $status)
    {
        try {
            $lab_test = LabTest::find($id);
            if ($lab_test == null) {
                Flashy::error(trans('m.item_not_found'));
                return redirect()->back();
            }
            if ($status != 0 && $status != 1) {
                Flashy::error(trans('m.non_status'));
            } else {
                $lab_test->update(['status' => $status]);
                Flashy::success(trans('m.status_changed_succ'));
            }
            return redirect()->route('lab_tests.index');
        } catch (Exception $ex) {
            return $this->getViewException($ex);
        }
    }
}

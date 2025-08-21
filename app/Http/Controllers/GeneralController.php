<?php
namespace App\Http\Controllers;
use App\Traits\Dashboard\PublicTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utilities\MLaratables;
use Illuminate\Support\Facades\Validator;
use MercurySeries\Flashy\Flashy;
class GeneralController extends Controller
{
    use  PublicTrait;
    public function search(Request $request)
    {
        $queryStr = $request->queryStr;
        $type = $request->type_id;
        if ($type) {
            if ($type == 'branch') {
                return BranchController::getDataByQueryStr($queryStr);
            } else if ($type== 'doctor') {
                return DoctorController::getDataByQueryStr($queryStr);
            } else if ($type == 'users') {
                return UserController::getDataByQueryStr($queryStr);
            }
        }
        return redirect()->route('home');
    }

}

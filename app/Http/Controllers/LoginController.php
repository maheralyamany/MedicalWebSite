<?php
namespace App\Http\Controllers;
use App\Models\AdminWebToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;
use App\Models\User;
use App\Models\UsersGroup;
use App\Providers\RouteServiceProvider;
use App\Services\Login\RememberMeExpiration;
use App\Traits\CheckPermissionsTrait;
use App\Utilities\BranchDataSession;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{

    public function show()
    {
        return view("auth.login");
    }
   
  /*   public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        if(!Auth::validate($credentials)):
             return redirect()->back()->with("user-error",trans('auth.failed'));
        endif;
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::guard()->login($user);
        return $this->authenticated($request, $user);
    } */
    public function login(LoginRequest $request)
    {
        
       
        $data = "mobile";
        $user =  User::where($data, $request->mobile)->first();
        if (!$user)
            return redirect()->back()->with("user-error", 'المستخدم غير موجود');
        if (md5($request->password)==$user->password) {
           // $user = User::where($data, $user->mobile)->first();
            Auth::guard()->login($user);
            BranchDataSession::clear();
           // return $this->authenticated($request, $user);
            return redirect(RouteServiceProvider::HOME);
        } else {
          
         
            return redirect()->back()->with("user-error",trans('auth.failed'));
        }
    }
   /*  protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    } */
}

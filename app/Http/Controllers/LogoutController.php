<?php

namespace App\Http\Controllers;

use App\Utilities\BranchDataSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function perform()
    {
        Session::flush();
        BranchDataSession::clear();
        Auth::logout();
        return redirect('login');
    }
}

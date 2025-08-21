<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Reservation;
use App\Models\Specification;
use App\Models\User;
use App\Traits\Dashboard\PublicTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use  Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use PublicTrait;

    public function index()
    {
        $data['activeDoctorsCount'] = count($this->getActiveDoctors());
        $data['activeUsersCount'] = User::active()->count();
        $data['usersCount'] = User::count();
        return view('home', $data);

    }
}

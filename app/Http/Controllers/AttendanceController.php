<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index() 
    {
        if(isset(Auth::user()->apprenticeTeam))
        {
            if(Auth::user()->apprenticeTeam->status_hired == "DI TOLAK" || 
               Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES")
            {
                return response(abort(403));
            }else {
                return view("pages.dashboard.attendance.index");
            }
        }
        else 
        {
            return view("pages.dashboard.attendance.index");
        }

    }
}

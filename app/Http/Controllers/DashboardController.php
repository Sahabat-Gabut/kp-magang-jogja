<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{TeamApprentice,Admin};

class DashboardController extends Controller
{
    public function index()
    {
        $team_apprentice    = \Auth::user()->apprenticeTeam;
        $total_team         = TeamApprentice::where("status_hired","DI TERIMA")->count();
        $total_submission   = TeamApprentice::where('status_hired','SEDANG DIPROSES')->count();
        $total_project      = TeamApprentice::where("status_hired","DI TERIMA")->count();
        $total_admin        = Admin::count();

        return view('pages.dashboard.index')->with(compact('team_apprentice','total_team','total_submission','total_project','total_admin'));
    }
}

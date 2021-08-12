<?php

namespace App\Http\Controllers;

use App\Models\{Team,Admin, Project};
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $isSuperAdmin = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check() ) {
                $this->auth               = Auth::user();
                $this->user               = $this->auth->load(['admin.role','admin.agency']);
                if($this->user->admin) {
                    $this->isSuperAdmin   = $this->user->admin->role->id == 1;
                }
            }
           return $next($request);
       });
    }

    public function index()
    {
        $title            = "Dasbor";
        $team             = Auth::user()->apprenticeTeam;
        $total_team       = 0;
        $total_project    = 0;
        $total_submission = 0;
        $total_admin      = 0;
        
        if($this->user->admin) {
            if($this->isSuperAdmin) {
                $total_team         = Team::where("status","DITERIMA")->count();
                $total_submission   = Team::where('status','SEDANG DIPROSES')->count();
                $total_admin        = Admin::count();
                $total_project      = Project::count();
            }else {
                $total_team         = Team::where("status","DITERIMA")->where('agency_id', $this->user->admin->agency_id)->count();
                $total_submission   = Team::where('status','SEDANG DIPROSES')->where('agency_id',$this->user->admin->agency_id)->count();
                $total_admin        = Admin::where('agency_id', $this->user->admin->agency_id)->count();
                $total_project      = Project::join('team','project.team_id','=','team.id')->where('agency_id',$this->user->admin->agency_id)->count();
            }
        }
        
        return Inertia::render('Dashboard',compact('team','total_team','total_submission','total_admin','total_project','title'));
    }
}

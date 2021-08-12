<?php

namespace App\Http\Controllers;

use App\Http\Resources\{AttendanceCollenction, ApprenticeSelectCollection, TeamCollection};
use App\Models\Agency;
use App\Models\Apprentice;
use App\Models\Attendance;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $isSuperAdmin = false, $isAdminAgency = false, $apprentice, $agency;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                $this->user               = Auth::user();
                $this->auth               = $this->user->load(['admin.role','admin.agency','apprentice']);
                
                if(null != $this->auth->admin) {
                    $this->isSuperAdmin   = $this->auth->admin->role->id == "1";
                    $this->isAdminAgency  = $this->auth->admin->agency_id == $request->agency_id;
                }
                $this->apprentice         = Apprentice::where('team_id',$request->team_id)->get();
                $this->agency             = Agency::where("id",$request->agency_id)->first();
            }
           return $next($request);
       });
    }

    public function index()
    {
        $team = '';
        if($this->auth->admin) {
            $team   = $this->isSuperAdmin   ? Team::with('apprentices.jss', 'project')
                                                ->where('status', '=', 'DITERIMA')
                                            : Team::with('apprentices.jss','project', 'agencies')
                                                ->where('status', '=', 'DITERIMA')
                                                ->where('agency_id', '=', $this->auth->admin->agency_id);

            $team   = new TeamCollection($team->filter(RequestFacade::only('search'))->paginate(20)->appends(RequestFacade::all()));
        } else {
            $team   = new AttendanceCollenction(Attendance::with('apprentice.team','apprentice.jss')
                                                                                  ->where('apprentice_id', $this->auth->apprentice->id)
                                                                                  ->filter(RequestFacade::only('search'))
                                                                                  ->paginate(20)
                                                                                  ->appends(RequestFacade::all()));
        }

        return Inertia::render('Attendance/Index',[
            'title'                 => 'Absensi',
            'filters'               => RequestFacade::all('search'), 
            'team_paginate'         => $team,
            'attendance_paginate'   => $team
        ]);
    }

    public function show($id)
    {
        $request    = RequestFacade::all('search','select','show');
        $callback   = function($query) use($id) {
            $query->where('apprentice.team_id','=', $id);
        };

        return Inertia::render('Attendance/Show', [
            'title'                 => 'Absensi',
            'filters'               => $request,
            'apprentices'           => new ApprenticeSelectCollection(Apprentice::with('jss')->where('team_id','=',$id)->get()),
            'attendance_paginate'   => new AttendanceCollenction(Attendance::whereHas('apprentice', $callback)
                                                                            ->with('apprentice.jss')
                                                                            ->filter(RequestFacade::only('search','select'))
                                                                            ->paginate($request['show'])
                                                                            ->appends(RequestFacade::all()))
        ]);
    }

    public function update(Attendance $attendance,Request $request)
    {
        if(!$request->status) {
            $carbon = new Carbon();
            if($attendance->end_attendance <= $carbon) {
              $request->status = 'TERLAMBAT';  
            } else {
                $request->status = 'TEPAT WAKTU';
            }
        }
        $update = $attendance->update([
            'status'  => $request->status
        ]);

        if($update) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil memperbarui absen.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal memperbarui absen.'
            ]);
        }    
    }

    public function destroy(Attendance $attendance)
    {
        $delete = $attendance->delete();

        if($delete) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Absen berhasil dihapus.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Absen gagal dihapus.'
            ]);
        }
    }
}

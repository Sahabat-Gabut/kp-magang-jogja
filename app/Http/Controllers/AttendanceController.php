<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{TeamApprentice, Jss, Apprentice, Attendance};
class AttendanceController extends Controller
{
    public function index() {
        setlocale(LC_TIME, 'id_ID');
        if(isset(Auth::user()->apprenticeTeam)) {
            if(Auth::user()->apprenticeTeam->status_hired == "DI TOLAK" || 
               Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES") {
                return responsea(abort(403));
            } else {
                $absen = Attendance::where('apprentice_id',Auth::user()->apprenticeDetail->id)->with('apprentice')->orderBy('start_attendace', 'asc')->get();
                return view("pages.dashboard.attendance.index")->with(compact('absen'));
            }
        } else {
            $team = TeamApprentice::all();
            return view("pages.dashboard.attendance.index")->with(compact('team'));
        } 
    }

    public function detail($id){
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }else {
            $apprentice = Apprentice::with('attendance')->where('team_apprentice_id',$id)->get();
            $attendance =  \DB::table('apprentice')
                            ->join('attendance', 'apprentice.id', '=', 'attendance.apprentice_id')
                            ->join('jss', 'apprentice.jss_id', '=', 'jss.id')
                            ->where('team_apprentice_id', $id)
                            ->orderBy('attendance.start_attendace', 'asc')
                            ->select('apprentice.*', \DB::raw('attendance.id as attendance_id'), 'attendance.*','jss.*')
                            ->get();
                            
            return view('pages.dashboard.attendance.detail')->with(compact(['apprentice','attendance']));
        }
    }
}

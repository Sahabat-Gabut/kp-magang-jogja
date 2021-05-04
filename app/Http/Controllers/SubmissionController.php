<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{TeamApprentice,Agency,Apprentice, Attendance};
use Illuminate\Support\Facades\Auth;
class SubmissionController extends Controller
{
    protected $isAdmin, $isSuperAdmin, $isAdminFromAgency, $apprentice, $agency;

    public function __construct(Request $request) 
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check() ) {
                $this->isAdmin            = \Auth::user()->adminDetail;
                $this->isSuperAdmin       = \Auth::user()->adminRole->id == "1";
                $this->isAdminFromAgency  = \Auth::user()->adminDetail->agency_id == $request->agency_id;
                $this->apprentice         = Apprentice::where('team_apprentice_id',$request->team_apprentice_id)->get();
                $this->agency             = Agency::where("id",$request->agency_id)->first();
            }
           return $next($request);
       });

    }
    
    public function index()
    {
        if (!$this->isAdmin) {
            return response(abort(403));
        }
        if($this->isSuperAdmin) {
            $submission = TeamApprentice::all();
        } else {
            $submission = TeamApprentice::where("agency_id", \Auth::user()->adminDetail->agency_id)->get();
        }
        return view('pages.dashboard.submission.index')->with(compact('submission'));
    }
    
    public function detail($id)
    {
        if (!$this->isAdmin) {
            return response(abort(403));
        }else {
            if($this->isSuperAdmin){
                $submission = TeamApprentice::find($id);                
                return view('pages.dashboard.submission.detail')->with(compact('submission'));
            }else {
                $submission = TeamApprentice::where("id",$id)
                                            ->where("agency_id", \Auth::user()->adminDetail->agency_id)
                                            ->first();    
                if($submission != NULL) {
                    return view('pages.dashboard.submission.detail')->with(compact('submission'));
                } else {
                    return response(abort(403));
                }
            }
        }
    }

    public function reject(Request $request)
    {
        $total              = $this->agency->total_team - 1;

        if (!$this->isAdmin) { return response(abort(403)); } 
        else if($this->isSuperAdmin || $this->isAdminFromAgency){
            $update           = TeamApprentice::where('id',$request->team_apprentice_id)->where('agency_id', $request->agency_id)->update(['status_hired' => 'DI TOLAK']);

            foreach($this->apprentice as $key => $a) {
                $remove_attendance = Attendance::where(['apprentice_id'   => $a->id ])->delete();                    
            }

            if($update && $remove_attendance) {
                Agency::where("id", $request->agency_id)->update(['total_team' => $total]);
                return $this->success("Berhasil menolak pengajuan");

            }else {
                return $this->errors("Gagal menolak pengajuan");
            }
        }
        return response(abort(403));
    }

    public function accept(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $apprentice         = Apprentice::where('team_apprentice_id',$request->team_apprentice_id)->get();
        $teamApprentice     = TeamApprentice::where('id',$request->team_apprentice_id)->first();
        $total              = $this->agency->total_team + 1;
        $generateAttendance = $this->generateAttendance($teamApprentice->duration);

        if (!$this->isAdmin) { return response(abort(403)); } 
        else if($this->isSuperAdmin || $this->isAdminFromAgency) { 
            $update_status      = TeamApprentice::where('id',$request->team_apprentice_id)->where('agency_id', $request->agency_id)->update(['status_hired' => 'DI TERIMA']);
            $update_quota       = Agency::where("id", $request->agency_id)->update(['total_team' => $total]);
            $insert_attendance  = $this->handleAttendance($generateAttendance, $apprentice);
    
            if($update_status && $update_quota && $insert_attendance) {
                return $this->success("Pengajuan berhasil disetujui");
            }else {
                return $this->errors("Gagal menyetujui pengajuan");
            }
        } 

        return response(abort(403));
    }

    public function success($message)
    {
        session()->flash('success', 'success');
        session()->flash('title', 'Berhasil');
        session()->flash('message', $message);
        return redirect("submission");
    }

    public function errors($message)
    {
        session()->flash('errors', 'errors');
        session()->flash('title', 'Gagal');
        session()->flash('message', $message);
        return redirect("submission");
    }

    public function handleAttendance($dateOfMonth, $apprentice)
    {
        foreach($dateOfMonth as $key => $d) {
            foreach($apprentice as $key => $a) {
                $insert_attendance = Attendance::create([
                                        'start_attendace' => $d." 07:30:00.000000",
                                        'end_attendace'   => $d." 08:00:00.000000",
                                        'apprentice_id'   => $a->id
                                    ]);                    
            }
        }
        return $insert_attendance;
    }

    function generateAttendance($duration) 
    {
        $day			= floor($duration * date('t'));
        $start_date 	= date('Y-m-d');
        $start_time 	= strtotime($start_date);
        $end_time 		= strtotime("+".$day." day", $start_time);

        for($i=$start_time; $i<$end_time; $i+=86400)
        {
            if(date('D', $i) != "Sat" && date('D', $i) != "Sun")
            {
                $list[] = date('Y-m-d', $i);
            }
        }
        return $list;
    }
}

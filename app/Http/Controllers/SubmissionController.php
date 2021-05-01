<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{TeamApprentice,Agency,Apprentice, Attendance};

class SubmissionController extends Controller
{
    
    public function index()
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }
        if(\Auth::user()->adminRole->id == "1") {
            $submission = TeamApprentice::all();
        } else {
            $submission = TeamApprentice::where("agency_id", \Auth::user()->adminDetail->agency_id)->get();
        }
        return view('pages.dashboard.submission.index')->with(compact('submission'));
    }
    
    public function detail($id)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }else {
            if(\Auth::user()->adminRole->id == "1"){
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

    public function reject($id, $agency)
    {
        $isAdmin            = \Auth::user()->adminDetail;
        $isSuperAdmin       = \Auth::user()->adminRole->id == "1";
        $apprentice         = Apprentice::where('team_apprentice_id',$id)->get();
        $isAdminFromAgency  = \Auth::user()->adminDetail->agency_id == $agency;
        $countApprentice    = Apprentice::where('team_apprentice_id',$id)->count();
        $countAgency        = Agency::where("id",$agency)->get();
        $total              = $countAgency[0]->total_apprentice - $countApprentice;

        if (!$isAdmin) {
            return response(abort(403));
        }

        if($isSuperAdmin){
            $update           = TeamApprentice::where('id',$id)->where('agency_id', $agency)->update(['status_hired' => 'DI TOLAK']);

            foreach($apprentice as $key => $a) {
                $remove_attendance = Attendance::where(['apprentice_id'   => $a->id ])->delete();                    
            }

            if($update && $remove_attendance) {
                Agency::where("id", $agency)->update(['total_apprentice' => $total]);
            
                return $this->success("Berhasil menolak pengajuan");
            }else {
                return $this->errors("Gagal menolak pengajuan");
            }

        } else if($isAdminFromAgency){
            $update             = TeamApprentice::where('id',$id)->where('agency_id', $agency)->update(['status_hired' => 'DI TOLAK']);

            foreach($apprentice as $key => $a) {
                $remove_attendance = Attendance::where(['apprentice_id'   => $a->id ])->delete();                    
            }
            
            if($update && $remove_attendance) {
                Agency::where("id", $agency)->update(['total_apprentice' => $total]);
                        
                return $this->success("Berhasil menolak pengajuan");
            }else {
                return $this->errors("Gagal menolak pengajuan");
            }
        }
        return response(abort(403));
    }

    public function accept($id, $agency)
    {
        date_default_timezone_set("Asia/Jakarta");

        
        $isAdmin            = \Auth::user()->adminDetail;
        $superAdmin         = \Auth::user()->adminRole->id == "1";
        $isAdminFromAgency  = \Auth::user()->adminDetail->agency_id == $agency;
        
        $apprentice         = Apprentice::where('team_apprentice_id',$id)->get();
        $teamApprentice     = TeamApprentice::where('id',$id)->get();

        $countApprentice    = Apprentice::where('team_apprentice_id',$id)->count();
        $countAgency        = Agency::where("id",$agency)->get();
        $total              = $countAgency[0]->total_apprentice + $countApprentice;

        $generateAttendance = $this->generateAttendance($teamApprentice[0]->duration);


        if (!$isAdmin) {
            return response(abort(403));
        } else if($superAdmin) {
            $update             = TeamApprentice::where('id',$id)->where('agency_id', $agency)->update(['status_hired' => 'DI TERIMA']);
            $insert_attendance  = $this->handleAttendance($generateAttendance, $apprentice);

            if($update) {
                Agency::where("id", $agency)->update(['total_apprentice' => $total]);
                return $this->success("Pengajuan berhasil disetujui");
            }else {
                return $this->errors("Gagal menyetujui pengajuan");
            }

        } else if($isAdminFromAgency) {
            $update             = TeamApprentice::where('id',$id)->where('agency_id', $agency)->update(['status_hired' => 'DI TERIMA']);
            $insert_attendance  = $this->handleAttendance($generateAttendance, $apprentice);

            if($update && $insert_attendance) {
                Agency::where("id", $agency)->update(['total_apprentice' => $total]);
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

    function generateAttendance($duration) {
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

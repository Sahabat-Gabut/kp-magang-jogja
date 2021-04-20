<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{TeamApprentice,Agency,Apprentice};

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
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }

        if(\Auth::user()->adminRole->id == "1"){
            $update = TeamApprentice::where('id',$id)
                                    ->where('agency_id', $agency)
                                    ->update(['status_hired' => 'DI TOLAK']);
            
            $countApprentice  = Apprentice::where('team_apprentice_id',$id)->count();
            $countAgency      = Agency::where("id",$agency)->get();
            $total            = $countAgency[0]->total_apprentice - $countApprentice;

            if($update) {
                Agency::where("id", $agency)
                        ->update(['total_apprentice' => $total]);
                        
                session()->flash('success', 'success');
                session()->flash('title', 'Berhasil');
                session()->flash('message', 'Pengajuan berhasil ditolak');
                return redirect("submission");
            }else {
                session()->flash('errors', 'errors');
                session()->flash('title', 'Gagal');
                session()->flash('message', 'Gagal menolak pengajuan');
                return redirect("submission");
            }
        } else if(\Auth::user()->adminDetail->agency_id == $agency){
            $update = TeamApprentice::where('id',$id)
                                    ->where('agency_id', $agency)
                                    ->update(['status_hired' => 'DI TOLAK']);
    
            $countApprentice  = Apprentice::where('team_apprentice_id',$id)->count();
            $countAgency      = Agency::where("id",$agency)->get();
            $total            = $countAgency[0]->total_apprentice - $countApprentice;
            
            if($update) {
                Agency::where("id", $agency)
                        ->update(['total_apprentice' => $total]);
                        
                session()->flash('success', 'success');
                session()->flash('title', 'Berhasil');
                session()->flash('message', 'Pengajuan berhasil ditolak');
                return redirect("submission");
            }else {
                session()->flash('errors', 'errors');
                session()->flash('title', 'Gagal');
                session()->flash('message', 'Gagal menolak pengajuan');
                return redirect("submission");
            }
        }
        return response(abort(403));
    }

    public function accept($id, $agency)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        } else if(\Auth::user()->adminRole->id == "1"){
            $update = TeamApprentice::where('id',$id)
                                    ->where('agency_id', $agency)
                                    ->update(['status_hired' => 'DI TERIMA']);

            $countApprentice  = Apprentice::where('team_apprentice_id',$id)->count();
            $countAgency      = Agency::where("id",$agency)->get();
            $total            = $countAgency[0]->total_apprentice + $countApprentice;

            if($update) {
                Agency::where("id", $agency)
                           ->update(['total_apprentice' => $total]);
    
                session()->flash('success', 'success');
                session()->flash('title', 'Berhasil');
                session()->flash('message', 'Pengajuan berhasil disetujui');
                return redirect("submission");
            }else {
                session()->flash('errors', 'errors');
                session()->flash('title', 'Gagal');
                session()->flash('message', 'Gagal menyetujui pengajuan');
                return redirect("submission");
            }
        } else if(\Auth::user()->adminDetail->agency_id == $agency) {

            $update = TeamApprentice::where('id',$id)
                                    ->where('agency_id', $agency)
                                    ->update(['status_hired' => 'DI TERIMA']);

            $countApprentice  = Apprentice::where('team_apprentice_id',$id)->count();
            $countAgency      = Agency::where("id",$agency)->get();
            $total            = $countAgency[0]->total_apprentice + $countApprentice;

            if($update) {
                Agency::where("id", $agency)
                        ->update(['total_apprentice' => $total]);

                session()->flash('success', 'success');
                session()->flash('title', 'Berhasil');
                session()->flash('message', 'Pengajuan berhasil disetujui');
                return redirect("submission");
            }else {
                session()->flash('errors', 'errors');
                session()->flash('title', 'Gagal');
                session()->flash('message', 'Gagal menyetujui pengajuan');
                return redirect("submission");
            }
        }
        return response(abort(403));
    }
}

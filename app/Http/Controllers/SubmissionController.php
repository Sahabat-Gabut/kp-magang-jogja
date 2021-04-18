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

        $submission = TeamApprentice::all();
        return view('pages.dashboard.submission.index')->with(compact('submission'));
    }

    public function detail($id)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }
        $submission = TeamApprentice::find($id);
        return view('pages.dashboard.submission.detail')->with(compact('submission'));
    }

    public function reject($id, $agency)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }

        $update = TeamApprentice::where('id',$id)
                  ->update(['status_hired' => 'DI TOLAK']);

        $countApprentice  = Apprentice::where('team_apprentice_id',$id)->count();
        $countAgency      = Agency::where("id",$agency)->get();
        $total            = $countAgency[0]->total_apprentice - $countApprentice;

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

    public function accept($id, $agency)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }

        $update = TeamApprentice::where('id',$id)
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
}

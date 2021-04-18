<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamApprentice;

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

    public function reject($id)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }

        $update = TeamApprentice::where('id',$id)
                  ->update(['status_hired' => 'DI TOLAK']);

        if($update) {
            return redirect("submission")->with(["message", "berhasil ditolak"]);
        }else {
            return redirect("submission")->with(["message" => "gagal"]);
        }
    }

    public function accept($id)
    {
        if (!\Auth::user()->adminDetail) {
            return response(abort(403));
        }

        $update = TeamApprentice::where('id',$id)
                  ->update(['status_hired' => 'DI TERIMA']);

        if($update) {
            return redirect("submission")->with(["message", "berhasil diterima"]);
        }else {
            return redirect("submission")->with(["message" => "gagal"]);
        }
    }
}

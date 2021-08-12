<?php

namespace App\Http\Controllers;

use App\Models\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ValuationController extends Controller
{
    public function store(Request $request)
    {
        $insert = Valuation::create([
            'progress_project_id' => $request->progress_project_id,
            'score' => $request->score,
            'description' => $request->description
        ]);
        
        if($insert) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil memberi nilai.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal memberi nilai.'
            ]);
        }
    }

    public function update(Valuation $valuation, Request $request)
    {
        $update = $valuation->update([
            'progress_project_id' => $request->progress_project_id,
            'score' => $request->score,
            'description' => $request->description
        ]);

        if($update) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil mengubah nilai.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal mengubah nilai.'
            ]);
        }
    }
}

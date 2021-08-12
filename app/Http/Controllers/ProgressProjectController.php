<?php

namespace App\Http\Controllers;

use App\Models\ProgressProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProgressProjectController extends Controller
{

    public function show(ProgressProject $progressProject) 
    {
        $progressProject = $progressProject->load(['jss','valuation']);
        return Inertia::render('Project/Progress/Show',[
            'title' => $progressProject->name,
            'progress' => $progressProject
        ]);
    }

    public function store(Request $request)
    {
       $insert =  ProgressProject::create([
            'project_id'    => $request->project_id,
            'apprentice_id' => $request->apprentice_id,
            'name'          => $request->name,
            'status'        => $request->status ? $request->status : 'PENGEMBANGAN'
        ]);

        if($insert) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Planning berhasil ditambahkan.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Planning gagal ditambahkan.'
            ]);
        }
    }

    public function update(ProgressProject $progressProject, Request $request)
    {
       $update =  $progressProject->update([
            'apprentice_id' => $request->apprentice_id,
            'project_id'    => $request->project_id,
            'name'          => $request->name,
            'status'        => $request->status
        ]);

        if($update) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Planning berhasil diupdate.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Planning gagal diupdate.'
            ]);
        }
    }

    public function destroy(ProgressProject $progressProject)
    {
       $delete =  $progressProject->delete();

        if($delete) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Planning berhasil dihapus.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Planning gagal dihapus.'
            ]);
        }
    }
}

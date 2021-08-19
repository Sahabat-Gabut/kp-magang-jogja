<?php

namespace App\Http\Controllers;

use App\Models\ProgressProject;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProgressProjectController extends Controller
{
    protected $isSuperAdmin = false, $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->auth = Auth::user();
                $this->user = $this->auth->load(['admin.role', 'admin.agency', 'apprentice']);
                if ($this->user->admin) {
                    $this->isSuperAdmin = $this->user->admin->role->id == 1;
                }
            }
            return $next($request);
        });

    }

    public function show(ProgressProject $progressProject): Response
    {
        $progressProject = $progressProject->load(['jss', 'valuation']);
        if ($this->user->apprentice || $this->user->admin) {
            return Inertia::render('Project/Progress/Show', [
                'title' => $progressProject->name,
                'progress' => $progressProject,
            ]);
        }
        return Inertia::render('Error', ['status' => 403]);
    }

    public function store(Request $request): RedirectResponse
    {
        $insert = ProgressProject::create([
            'project_id' => $request->project_id,
            'apprentice_id' => $request->apprentice_id,
            'name' => $request->name,
            'status' => $request->status ? $request->status : 'PENGEMBANGAN',
        ]);

        if ($insert) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Planning berhasil ditambahkan.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Planning gagal ditambahkan.',
            ]);
        }
    }

    public function update(ProgressProject $progressProject, Request $request): RedirectResponse
    {
        $update = $progressProject->update([
            'apprentice_id' => $request->apprentice_id,
            'project_id' => $request->project_id,
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
        ]);

        $project = Project::find($request->project_id);
        $percentage = $project->percentageTeam2($project);

        if ($percentage == 100) {
            $project->update([
                'status' => 'SELESAI',
            ]);
        } else {
            $project->update([
                'status' => 'PENGEMBANGAN',
            ]);
        }

        if ($update) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Planning berhasil diupdate.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Planning gagal diupdate.',
            ]);
        }
    }

    public function destroy(ProgressProject $progressProject): RedirectResponse
    {
        $delete = $progressProject->delete();

        if ($delete) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Planning berhasil dihapus.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Planning gagal dihapus.',
            ]);
        }
    }
}

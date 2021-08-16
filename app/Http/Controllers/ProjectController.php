<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Models\Agency;
use App\Models\Apprentice;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                $this->auth               = Auth::user();
                $this->isAdmin            = $this->auth->load(['admin.role','admin.agency']);
                $this->user               = $this->auth->load(['apprentice.team']);
                $this->isSuperAdmin       = isset($this->isAdmin->admin->role->id) == "1";

                if(null != isset($this->isAdmin->admin->agency_id)) {
                    $this->isAdminAgency  = $this->isAdmin->admin->agency_id == $request->agency_id;
                }
            }
           return $next($request);
       });
    }

    public function index()
    {
        if($this->isAdmin->admin) {
            $project_paginate = new ProjectCollection(Project::with('team.agency','team.apprentices.jss')->filter(RequestFacade::only('search'))->paginate(15)->appends(RequestFacade::all()));
        } else {
            $project = Project::with(['progress.jss', 'team.apprentices.jss','team.admin.jss'])->where('team_id',$this->user->apprentice->team->id)->first();
            $done = $project->progress->where('status','SELESAI')->count();

            $percentage = number_format($done/$project->progress->count()*100);
        }

        return Inertia::render('Project/Index',[
            'title'             => isset($project) ? $project->name : 'Daftar Projek',
            'filters'           => RequestFacade::all('search'),
            'project_paginate'  => $project_paginate ?? null,
            'project'           => $project ?? null,
            'percentage'        => $percentage ?? null
        ]);
    }

    public function store(Request $request)
    {
        $insert = Project::create([
            'team_id'       => $request->team_id,
            'name'          => $request->name,
            'description'   => $request->description,
        ]);

        $update = Team::find($request->team_id)->update([
            'admin_id'      => $request->admin_id
        ]);

        if($insert && $update) {
            return Redirect::back()->with([
                'type'      => 'success',
                'message'   => 'Projek berhasil diset.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error',
                'message'   => 'Projek gagal diset.'
            ]);
        }
    }

    public function show(Project $project)
    {
        $title   = $project->name;
        $project = $project->load('progress.jss', 'team.apprentices.jss', 'team.admin.jss');
        $done    = $project->progress->where('status', 'SELESAI')->count();
        $percentage = 0;

        if($done > 0) {
            $percentage = number_format($done/$project->progress->count()*100);
        }

        return Inertia::render('Project/Show', compact('title','project','percentage'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

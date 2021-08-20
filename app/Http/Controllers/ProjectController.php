<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginateCollenction;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    private $auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->auth = Auth::user()->load(['admin.role', 'admin.agency', 'apprentice.team']);
            }
            return $next($request);
        });
    }

    public function index(): Response
    {
        $project = (new Project)->get((bool)$this->auth->admin, $this->auth->admin->agency_id ?? 0);
        $filters = RequestFacade::all('search');
        $data_paginate = new PaginateCollenction(
            $project->filter(RequestFacade::only('search'))
                ->paginate(15)
                ->appends(RequestFacade::all()));
        $percentage = (new Project)->percentageTeam($project);
        $title = $this->auth->admin ? 'Daftar Projek' : $project->name;

        $project = $this->auth->admin ? null : $project;
        if ($this->auth->apprentice || $this->auth->admin) {
            return Inertia::render('Project/Index', compact(['title', 'filters', 'data_paginate', 'project', 'percentage']));
        }
        return Inertia::render('Error', ['status' => 403]);
    }

    public function store(Request $request): RedirectResponse
    {
        $insert = Project::create([
            'team_id' => $request->team_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $update = Team::find($request->team_id)->update([
            'admin_id' => $request->admin_id,
        ]);

        if ($insert && $update) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Projek berhasil diset.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Projek gagal diset.',
            ]);
        }
    }

    public function show(Project $project): Response
    {
        $title = $project->name;
        $project = $project->load('progress.jss', 'team.apprentices.jss', 'team.admin.jss');
        $done = $project->progress->where('status', 'SELESAI')->count();
        $percentage = 0;

        if ($done > 0) {
            $percentage = number_format($done / $project->progress->count() * 100);
        }
        if ($this->auth->apprentice || $this->auth->admin) {
            return Inertia::render('Project/Show', compact('title', 'project', 'percentage'));
        }
        return Inertia::render('Error', ['status' => 403]);
    }
}

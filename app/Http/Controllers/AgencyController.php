<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgencyCollenction;
use App\Models\Agency;
use App\Models\Apprentice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as RequestFacade;

class AgencyController extends Controller
{
    protected $isSuperAdmin = false, $isAdminAgency = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                $this->auth               = Auth::user();
                $this->user               = $this->auth->load(['admin.role','admin.agency','apprentice']);
                if($this->user->admin) {
                    $this->isSuperAdmin   = $this->user->admin->role->id == 1;
                }
            }
           return $next($request);
       });
    }

    public function index()
    {
        if(!$this->isSuperAdmin) {
            return abort(403);
        }
        return Inertia::render('Agency/Index',[
            'title'             => 'Daftar Dinas',
            'filters'           => RequestFacade::all('search'),
            'agency_paginate'   => new AgencyCollenction(
                Agency::filter(RequestFacade::only('search'))
                        ->orderBy('name')
                        ->paginate(RequestFacade::only('show'))
                        ->appends(RequestFacade::all())
            ),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Agency $agency, Request $request)
    {
        $update = $agency->update([
            'name'  => $request->name,
            'quota' => $request->quota,
            'location' => $request->location
        ]);
        if($update) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil mengubah dinas.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal mengubah dinas.'
            ]);
        }
    }

    public function destroy(Agency $agency)
    {
        $delete = $agency->delete();

        if($delete) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil menghapus dinas.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal menghapus dinas.'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminCollection;
use App\Models\Admin;
use App\Models\Agency;
use App\Models\Apprentice;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $isSuperAdmin = false, $isAdminAgency = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                $this->auth               = Auth::user();
                $this->user               = $this->auth->load(['admin.role','admin.agency','apprentice']);
                $this->isSuperAdmin       = isset($this->auth->admin->role->id) == "1";
                
                if($this->user->admin->agency_id) {
                    $this->isAdminAgency  = true;
                }
            }
           return $next($request);
       });
    }

    public function index()
    {
        
        if(isset($this->user->admin->role->id) != 1 && isset($this->user->admin->role->id) != 2) {
            return abort(403);
        }

        $admin = Admin::with('jss','role');

        if($this->isAdminAgency) {
            $admin = $admin->where('agency_id', '=', $this->user->admin->agency_id);
        }

        return Inertia::render('Admin/Index',[
            'title'          => 'Daftar Admin',
            'filters'        => Request::all('search'),
            'agencies'       => Agency::all(),
            'roles'          => Role::all(),
            'admin_paginate' => new AdminCollection(
                $admin
                ->filter(Request::only('search'))  
                ->paginate(15)
                ->appends(Request::all())
            )
        ]);
    }


    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    public function store(AdminRequest $request)
    {
        if($request->role_admin_id == "1") {
            $request->agency_id = NULL;
        } else if($request->agency_id == '0') {
            $request->agency_id = $this->user->admin->agency_id;
        }

        $insert = Admin::create([
            'jss_id' => $request->jss_id,
            'role_id'=> $request->role_id,
            'agency_id'=> $request->agency_id
        ]);

        if($insert) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Admin berhasil ditambahkan.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal menambahkan admin.'
            ]);
        }
    }


    public function show(Admin $admin)
    {
        return Inertia::render('Admin/Show', compact('admin'));
    }


    public function edit(Admin $admin)
    {
        return Inertia::render('Admin/Edit', compact('admin'));
    }

    public function update(Admin $admin, AdminRequest $request)
    {
        if($request->role_id == "1") {
            $request->agency_id = NULL;
        }

        $update = $admin->update([
            'jss_id'    => $request->jss_id,
            'role_id'   => $request->role_id,
            'agency_id' => $request->agency_id
        ]);

        if($update) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil mengubah admin.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal mengubah admin.'
            ]);
        }
    }

    public function destroy(Admin $admin)
    {
        $delete = $admin->delete();
        
        if($delete) {
            return Redirect::back()->with([
                'type'      => 'success', 
                'message'   => 'Berhasil menghapus admin.'
            ]);
        } else {
            return Redirect::back()->with([
                'type'      => 'error', 
                'message'   => 'Gagal menghapus admin.'
            ]);
        }
    }
}

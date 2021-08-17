<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\PaginateCollenction;
use App\Models\Admin;
use App\Models\Agency;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacades;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    private $auth, $isSuperAdmin = false, $isAdmin = false, $isAdminAgency = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->auth = Auth::user()->load(['admin.role', 'admin.agency', 'apprentice']);
                $this->isSuperAdmin = isset($this->auth->admin->role->id) == "1";
                $this->isAdmin = isset($this->auth->admin->role->id) == "2";
                if ($this->auth->admin) {
                    if ($this->auth->admin->agency_id) {
                        $this->isAdminAgency = true;
                    }
                }
            }
            return $next($request);
        });
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        if (!$this->isSuperAdmin && !$this->isAdmin) {
            return Inertia::render('Error', ['status' => 403]);
        }

        $admin = Admin::with('jss', 'role');

        if ($this->isAdminAgency) {
            $admin = $admin->where('agency_id', '=', $this->user->admin->agency_id);
        }

        $title = 'Daftar Admin';
        $filters = RequestFacades::all('search');
        $agencies = Agency::all();
        $roles = Role::all();
        $data_paginate = new PaginateCollenction(
            $admin->filter(RequestFacades::only('search'))
                ->paginate(15)
                ->appends(RequestFacades::all())
        );

        return Inertia::render('Admin/Index', compact(['title', 'filters', 'agencies', 'roles', 'data_paginate']));
    }


    public function create(): Response
    {
        return Inertia::render('Admin/Create');
    }

    public function store(AdminRequest $request): RedirectResponse
    {
        if ($request->role_admin_id == "1") {
            $request->agency_id = NULL;
        } else if ($request->agency_id == '0') {
            $request->agency_id = $this->user->admin->agency_id;
        }

        $insert = (new Admin)->create([
            'jss_id' => $request->jss_id,
            'role_id' => $request->role_id,
            'agency_id' => $request->agency_id,
        ]);

        if ($insert) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Admin berhasil ditambahkan.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal menambahkan admin.',
            ]);
        }
    }


    public function show(Admin $admin): Response
    {
        return Inertia::render('Admin/Show', compact('admin'));
    }


    public function edit(Admin $admin): Response
    {
        return Inertia::render('Admin/Edit', compact('admin'));
    }

    public function update(Admin $admin, AdminRequest $request): RedirectResponse
    {
        if ($request->role_id == "1") {
            $request->agency_id = NULL;
        }

        $update = $admin->update([
            'jss_id' => $request->jss_id,
            'role_id' => $request->role_id,
            'agency_id' => $request->agency_id,
        ]);

        if ($update) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Berhasil mengubah admin.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal mengubah admin.',
            ]);
        }
    }

    public function destroy(Admin $admin): RedirectResponse
    {
        $delete = $admin->delete();

        if ($delete) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Berhasil menghapus admin.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal menghapus admin.',
            ]);
        }
    }
}

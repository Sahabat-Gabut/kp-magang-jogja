<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginateCollenction;
use App\Models\Agency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;
use Inertia\Response;

class AgencyController extends Controller
{
    private $auth, $isSuperAdmin = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->auth = Auth::user()->load(['admin.role', 'admin.agency', 'apprentice']);
                if ($this->auth->admin) {
                    $this->isSuperAdmin = $this->auth->admin->role->id == 1;
                }
            }
            return $next($request);
        });
    }

    public function index(): Response
    {
        $title = 'Daftar Dinas';
        $filters = RequestFacade::all('search');
        $data_paginate = new PaginateCollenction(
            Agency::filter(RequestFacade::only('search'))
                ->orderBy('name')
                ->paginate(RequestFacade::only('show'))
                ->appends(RequestFacade::all())
        );
        if (!$this->auth->apprentice && !$this->isSuperAdmin) {
            return Inertia::render('Error', ['status' => 403]);
        }
        return Inertia::render('Agency/Index', compact(['title', 'filters', 'data_paginate']));
    }

    public function show(): Response
    {
        $title = 'Daftar Kuota Dinas';
        $agencies = Agency::all();
        return Inertia::render('Agency/Show', compact(['title', 'agencies']));
    }

    public function config(): Response
    {
        if ($this->auth->admin->role_id !== 2) {
            return Inertia::render('Error', ['status' => 403]);
        }
        $title = 'Pengaturan Dinas';
        $agency = Agency::find($this->auth->admin->agency_id);

        return Inertia::render('Agency/Config', compact('title', 'agency'));
    }

    public function update(Agency $agency, Request $request): RedirectResponse
    {
        $update = $agency->update([
            'name' => $request->name,
            'quota' => $request->quota,
            'location' => $request->location,
        ]);
        if ($update) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Berhasil mengubah dinas.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal mengubah dinas.',
            ]);
        }
    }

    public function destroy(Agency $agency): RedirectResponse
    {
        $delete = $agency->delete();

        if ($delete) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Berhasil menghapus dinas.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal menghapus dinas.',
            ]);
        }
    }
}

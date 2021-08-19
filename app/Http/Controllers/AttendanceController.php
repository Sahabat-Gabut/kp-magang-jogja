<?php

namespace App\Http\Controllers;

use App\Http\Resources\{ApprenticeSelectCollection, PaginateCollenction};
use App\Models\Apprentice;
use App\Models\Attendance;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;
use Inertia\Response;

class AttendanceController extends Controller
{
    private $auth, $isSuperAdmin = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->auth = Auth::user()->load(['admin.role', 'admin.agency', 'apprentice']);
                if ($this->auth->admin) {
                    $this->isSuperAdmin = $this->auth->admin->role->id == "1";
                }
            }
            return $next($request);
        });
    }

    public function index(): Response
    {
        $team = new Team();
        $agency_id = $this->auth->admin->agency_id ?? 0;
        if ($this->auth->admin) {
            $data_paginate = new PaginateCollenction(
                $team->getByRole($this->isSuperAdmin, $agency_id)
                    ->filter(RequestFacade::only('search'))
                    ->paginate(20)->appends(RequestFacade::all())
            );
        } else {
            $data_paginate = new PaginateCollenction(
                Attendance::with('apprentice.team', 'apprentice.jss')
                    ->where('apprentice_id', $this->auth->apprentice->id)
                    ->filter(RequestFacade::only('search'))
                    ->paginate(20)
                    ->appends(RequestFacade::all())
            );
        }
        if ($this->auth->apprentice || $this->auth->admin) {
            return Inertia::render('Attendance/Index', [
                'title' => 'Absensi',
                'filters' => RequestFacade::all('search'),
                'data_paginate' => $data_paginate,
            ]);
        }
        return Inertia::render('Error', ['status' => 403]);
    }

    public function show($id): Response
    {
        $filters = RequestFacade::all(['search', 'select', 'show']);
        $callback = function ($query) use ($id) {
            $query->where('apprentice.team_id', '=', $id);
        };
        if ($this->auth->apprentice || $this->auth->admin) {
            return Inertia::render('Attendance/Show', [
                'title' => 'Absensi',
                'filters' => $filters,
                'apprentices' => new ApprenticeSelectCollection(Apprentice::with('jss')->where('team_id', '=', $id)->get()),
                'attendance_paginate' => new PaginateCollenction(Attendance::whereHas('apprentice', $callback)
                    ->with('apprentice.jss')
                    ->filter(RequestFacade::only(['search', 'select']))
                    ->paginate($filters['show'])
                    ->appends(RequestFacade::all())),
            ]);
        }

        return Inertia::render('Error', ['status' => 403]);
    }

    public function update(Attendance $attendance, Request $request): RedirectResponse
    {
        if (!$request->status) {
            $carbon = new Carbon();
            if ($attendance->end_attendance <= $carbon) {
                $request->status = Attendance::LATE;
            } else {
                $request->status = Attendance::ONTIME;
            }
        }
        $update = $attendance->update([
            'status' => $request->status,
        ]);

        if ($update) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Berhasil memperbarui absen.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal memperbarui absen.',
            ]);
        }
    }

    public function destroy(Attendance $attendance): RedirectResponse
    {
        $delete = $attendance->delete();

        if ($delete) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Absen berhasil dihapus.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Absen gagal dihapus.',
            ]);
        }
    }
}

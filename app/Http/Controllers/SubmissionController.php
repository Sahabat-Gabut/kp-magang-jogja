<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginateCollenction;
use App\Models\Admin;
use App\Models\Agency;
use App\Models\Apprentice;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\Team;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class SubmissionController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->user = Auth::user()->load(['admin.role', 'admin.agency']);
            }
            return $next($request);
        });
    }

    public function index(): Response
    {
        if (!$this->user->admin) {
            return abort(403);
        }

        $title = 'Daftar Pengajuan';
        $filters = RequestFacade::all(['search', 'status']);
        $data_paginate = new PaginateCollenction(
            Team::with('apprentices.jss', 'agency')
                ->filter(RequestFacade::only(['search', 'status']))
                ->paginate(15)
                ->appends(RequestFacade::all()));

        return Inertia::render('Submission/Index', compact('title', 'filters', 'data_paginate'));
    }

    public function create(): Response
    {
        $title = 'Formulir Pendaftaran Magang';
        $options = (new Agency)->getAgencySelect();

        return Inertia::render('Submission/Create', compact('title', 'options'));
    }

    public function store(Request $request)
    {
        $presentation = $this->storeFile('public', $request->presentation['blob']);
        $cover_letter = $this->storeFile('public', $request->coverLetter['blob']);
        $proposal = $this->storeFile('public', $request->proposal['blob']);
        $team = Team::create([
            'agency_id' => $request->agency,
            'university' => $request->university,
            'department' => $request->department,
            'proposal' => $proposal,
            'presentation' => $presentation,
            'cover_letter' => $cover_letter,
            'date_start' => $request->dateStart,
            'date_finish' => $request->dateFinish,
            'status' => 'SEDANG DIPROSES',
            'date_of_created' => NOW()]);

        foreach ($request->participants as $key => $value) {

            $blob_cv = $request->participants[$key]['cv']['blob'];
            $blob_img = $request->participants[$key]['img']['blob'];

            $cv_file = $this->storeFile('public', $blob_cv);
            $img_file = $this->storeFile('public', $blob_img);

            Apprentice::create([
                'jss_id' => $value['jss_id'],
                'npm' => $value['npm'],
                'team_id' => $team->id,
                'cv' => $cv_file,
                'photo' => $img_file,
            ]);
        }
    }

    private function storeFile(string $path, string $blob): string
    {
        $extension = explode('/', explode(':', substr($blob, 0, strpos($blob, ';')))[1])[1];
        if ($extension == 'vnd.openxmlformats-officedocument.presentationml.presentation') {
            $extension = 'pptx';
        } else if ($extension == 'vnd.ms-powerpoint') {
            $extension = 'ppt';
        }
        $replace = substr($blob, 0, strpos($blob, ',') + 1);

        $file = str_replace($replace, '', $blob);
        $file = str_replace(' ', '+', $file);
        $file_name = Str::random(10) . '.' . $extension;

        Storage::disk($path)->put($file_name, base64_decode($file));
        return $file_name;
    }

    public function show(int $id): Response
    {
        $title = 'Detail Tim';
        $team = Team::with('apprentices', 'agency', 'apprentices.jss', 'project')->find($id);
        $admins = Admin::with('jss')->where('agency_id', $team->agency_id)->where('role_id', 3)->get();

        return Inertia::render('Submission/Show', compact('title', 'team', 'admins'));
    }

    /**
     * @throws Exception
     */
    public function update(Team $team, string $status)
    {
        if (!$this->user->admin) {
            return Inertia::render('Response/Index', ['status' => 403]);
        }

        $agency = Agency::find($team->agency_id);
        $current_quota = $agency->quota;
        $attendances = $this->generateAttendance($team->date_start, $team->date_finish);
        $apprentices = Apprentice::where('team_id', $team->id)->get();

        if ($status == 'DITERIMA') {
            $current_quota -= 1;
            return $this->accept($attendances, $apprentices, $team, $status, $current_quota);
        } else {
            $current_quota += 1;
            return $this->reject($apprentices, $team, $status, $current_quota);
        }
    }

    /**
     * @throws Exception
     */
    private function generateAttendance($date_start, $date_finish): array
    {
        $days = array();
        $date_start = new DateTime($date_start);
        $interval = new DateInterval('P1D');  // +1 day
        $date_end = new DateTime($date_finish);

        foreach (new DatePeriod($date_start, $interval, $date_end->add($interval)) as $key => $day) {
            $date_num = $day->format('N');
            if ($date_num < 6) {
                $date_format = new DateTime($day->format('Y-m-d'));
                $date_format2 = new DateTime($day->format('Y-m-d'));

                $days[$key]['start_attendance'] = $date_format->setTime(7, 30);
                $days[$key]['end_attendance'] = $date_format2->setTime(8, 00);
            }
        }

        return $days;
    }

    private function accept(array $attendances, $apprentices, Team $team, string $status, int $current_quota): RedirectResponse
    {
        $update_status = $team->update(['status' => $status]);
        $update_quota = Agency::find($team->agency_id)->update(['quota' => $current_quota]);

        foreach ($attendances as $attendance) {
            foreach ($apprentices as $apprentice) {
                $handle_attendance = Attendance::create([
                    'start_attendance' => $attendance['start_attendance'],
                    'end_attendance' => $attendance['end_attendance'],
                    'apprentice_id' => $apprentice->id,
                ]);
            }
        }

        if ($update_status && $update_quota && $handle_attendance) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Perngajuan berhasil disetujui.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal menyetujui pengajuan.',
            ]);
        }
    }

    private function reject($apprentices, Team $team, string $status, int $current_quota): RedirectResponse
    {
        $update_status = $team->update(['status' => $status]);
        $update_quota = Agency::find($team->agency_id)->update(['quota' => $current_quota]);
        $delete_project = Project::where('team_id', $team->id)->delete();

        foreach ($apprentices as $apprentice) {
            $handle_attendance = Attendance::where('apprentice_id', $apprentice->id)->delete();
        }

        if ($update_status && $update_quota && $handle_attendance || $delete_project) {
            return Redirect::back()->with([
                'type' => 'success',
                'message' => 'Perngajuan berhasil ditolak.',
            ]);
        } else {
            return Redirect::back()->with([
                'type' => 'error',
                'message' => 'Gagal menolak pengajuan.',
            ]);
        }
    }
}

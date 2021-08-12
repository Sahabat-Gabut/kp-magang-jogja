<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubmissionCollection;
use App\Models\Admin;
use App\Models\Agency;
use App\Models\Apprentice;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\Team;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SubmissionController extends Controller
{
    protected $isSuperAdmin = false, $isAdminAgency = false, $apprentice, $agency;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check() ) {
                $this->user               = Auth::user();
                $this->isAdmin            = $this->user->load(['admin.role','admin.agency']);
                $this->isSuperAdmin       = isset($this->isAdmin->admin->role->id) == "1";
                $this->isAdminFromAgency  = isset($this->isAdmin->admin->agency->id) == $request->agency_id;
                $this->apprentice         = Apprentice::where('team_id',$request->team_id)->get();
                $this->agency             = Agency::where("id",$request->agency_id)->first();
            }
           return $next($request);
       });
    }

    public function index()
    {
        if(isset($this->user->admin->role->id) == null) {
            return abort(403);
        }
        return Inertia::render('Submission/Index',[
            'title'                 => 'Daftar Pengajuan',
            'filters'               => RequestFacade::all(['search','status']),
            'submission_paginate'   => new SubmissionCollection(Team::with('apprentices','agency')
                                                                    ->filter(RequestFacade::only(['search','status']))
                                                                    ->paginate(15)
                                                                    ->appends(RequestFacade::all()))
        ]);
    }

    public function create()
    {
        return Inertia::render('Submission/Create',[
            'title'       => 'Formulir Pendaftaran Magang',
            'options'     => Agency::where('quota', '>', 0)->get(['id AS value', 'name as label'])
        ]);
    }

    public function store(Request $request)
    {
        $presentation       = $this->storeFile('public',$request->presentation['blob']);
        $cover_letter       = $this->storeFile('public',$request->coverLetter['blob']);
        $proposal           = $this->storeFile('public',$request->proposal['blob']);
        $team               = Team::create([
                                'agency_id'     => $request->agency,
                                'university'    => $request->university,
                                'departement'   => $request->departement,
                                'proposal'      => $proposal,
                                'presentation'  => $presentation,
                                'cover_letter'  => $cover_letter,
                                'date_start'    => $request->dateStart,
                                'date_finish'   => $request->dateFinish,
                                'status'        => 'SEDANG DIPROSES',
                                'date_of_created' => NOW()]);
        
        // Project::create([
        //     'team_id'       => $team_id,
        //     'name'          => $request->projectName,
        //     'description'   => $request->projectDesc
        // ]);

        foreach($request->participants as $key => $value) {

            $blob_cv    = $request->participants[$key]['cv']['blob'];            
            $blob_img   = $request->participants[$key]['img']['blob'];
            
            $cv_file    = $this->storeFile('public',$blob_cv);
            $img_file   = $this->storeFile('public', $blob_img);

            Apprentice::create([
                'jss_id'     => $value['jss_id'], 
                'npm'        => $value['npm'],
                'team_id'    => $team->id, 
                'cv'         => $cv_file,
                'photo'      => $img_file
            ]);
        }
    }

    public function show($id)
    {
        $team = Team::with('apprentices','agency','apprentices.jss','project')->find($id);
        $admin = Admin::with('jss')->where('agency_id', $team->agency_id)->where('role_id', 3)->get();

        return Inertia::render('Submission/Show',[
            'title' => 'Detail Tim',
            'admins'=> $admin,
            'team'  => $team 
        ]);
    }

    public function update(Team $team, string $status)
    {
        if(!$this->isAdmin) {
            return Inertia::render('Response/Index',['status' => 403]);
        }
        
        $agency             = Agency::find($team->agency_id);
        $current_quota      = $agency->quota;
        $days               = array();
        $apprentices        = Apprentice::where('team_id', $team->id)->get();
        $date_start         = new DateTime($team->date_start);
        $interval           = new DateInterval('P1D'); // +1 day
        $date_end           = new DateTime($team->date_finish);

        if($status == 'DITERIMA') { $current_quota -= 1;} 
        else { $current_quota += 1; }

        foreach(new DatePeriod($date_start, $interval, $date_end->add($interval)) as $key => $day) {
            $date_num = $day->format('N'); 
            if($date_num < 6) $days[$key] = $day;
        }

        $update_status       = $team->update(['status' => $status]);
        $update_quota        = Agency::find($team->agency_id)->update(['quota' => $current_quota]);

        if($status == 'DITERIMA') {
            foreach($days as $day) {
                $start = new DateTime($day->format('Y-m-d'));
                $end   = new DateTime($day->format('Y-m-d'));
                foreach($apprentices as $apprentice) {
                    $handle_attendance  = Attendance::create([
                        'start_attendance' => $start->setTime(7,30),
                        'end_attendance'   => $end->setTime(8,00),
                        'apprentice_id'    => $apprentice->id
                    ]);
                }
            }
        } else {
            foreach($apprentices as $apprentice) {
                $handle_attendance = Attendance::where('apprentice_id', $apprentice->id)->delete();
            }
            Project::where('team_id', $team->id)->delete();
        }

        if($update_status && $update_quota && $handle_attendance) {
            if($status == 'DITERIMA') {
                return Redirect::back()->with([
                    'type'      => 'success', 
                    'message'   => 'Perngajuan berhasil disetujui.'
                ]);
            } else {
                return Redirect::back()->with([
                    'type'      => 'success', 
                    'message'   => 'Perngajuan berhasil ditolak.'
                ]);
            }
        } else {
            if($status == 'DITERIMA') {
                return Redirect::back()->with([
                    'type'      => 'error', 
                    'message'   => 'Gagal menyetujui pengajuan.'
                ]);
            } else {
                return Redirect::back()->with([
                    'type'      => 'error', 
                    'message'   => 'Gagal menolak pengajuan.'
                ]);
            }
        }
    }

    private function storeFile(string $path, string $blob) {
        $extension   = explode('/', explode(':', substr($blob, 0, strpos($blob, ';')))[1])[1];
        if($extension == 'vnd.openxmlformats-officedocument.presentationml.presentation') {
            $extension = 'pptx';
        } else if($extension == 'vnd.ms-powerpoint') {
            $extension = 'ppt';
        }
        $replace     = substr($blob, 0, strpos($blob, ',')+1); 

        $file        = str_replace($replace, '', $blob); 
        $file        = str_replace(' ', '+', $file); 
        $file_name   = Str::random(10).'.'.$extension;

        Storage::disk($path)->put($file_name, base64_decode($file));
        return $file_name;
    }
}

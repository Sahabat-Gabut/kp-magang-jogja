<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    TeamApprentice,
    ProgressProject,
    Project,
    Valuation
};

class ProjectController extends Controller {

    protected $status_hired, $isAdmin, $isSuperAdmin, $isApprentice;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check() ) {
                $this->isAdmin            = Auth::user()->adminDetail;
                if($this->isAdmin) {
                    $this->isSuperAdmin       = Auth::user()->adminRole->id == "1";
                }
                $this->isApprentice       = Auth::user()->apprenticeTeam;
                if($this->isApprentice){
                    $this->status_hired       = Auth::user()->apprenticeTeam->status_hired;
                }
            }
           return $next($request);
       });

    }

    public function index() {
        if($this->isApprentice) {
            if($this->status_hired == "DI TOLAK" || $this->status_hired == "SEDANG DIPROSES") {
                return response(abort('403'));
            } else {
                $team = TeamApprentice::where("status_hired","DI TERIMA")
                                    ->where("agency_id", Auth::user()->apprenticeTeam->agency_id)
                                    ->get();
                return view("pages.dashboard.project.index")->with(compact('team'));

            }
        }else if($this->isAdmin) {
            if($this->isSuperAdmin){
                $team = TeamApprentice::where("status_hired","DI TERIMA")->get();
                return view("pages.dashboard.project.index")->with(compact('team'));
            }else {
                $team = TeamApprentice::where("status_hired","DI TERIMA")
                                      ->where("agency_id", Auth::user()->adminDetail->agency_id)
                                      ->get();
                return view("pages.dashboard.project.index")->with(compact('team'));
            }
        }else {
            return response(abort('403'));
        }
    }

    public function detail($id) {
        if($this->isSuperAdmin|| $this->isApprentice) {
            $team       = TeamApprentice::where("status_hired","DI TERIMA")->where("id",$id)->first();
        }else {
            $team       = TeamApprentice::where("status_hired","DI TERIMA")->where("agency_id", Auth::user()->adminDetail->agency_id)->where("id",$id)->first();
            if($team == NULL) {
                return redirect("project");
            }
        }
        
        $project        = Project::where("team_apprentice_id", $team->id)->first();
        $progress       = ProgressProject::where("project_id",$project->id)->with('jss')->get();
        $countProgress  = ProgressProject::with(["project"])->where("project_id", $project->id)->count();
        $done           = ProgressProject::with(["project"])->where("project_id", $project->id)->where("status","SELESAI")->count();

        if($countProgress <= 0) {
            $percentage = 0;
        } else {
            $percentage = number_format($done/$countProgress*100);
        }

        if($this->isApprentice) {
            if($this->status_hired == "DI TOLAK" || $this->status_hired == "SEDANG DIPROSES"){
                return response(abort('403'));
            } else {
                return view('pages.dashboard.project.detail')->with(compact("team","progress","percentage","project"));
            }
        } else {
            return view('pages.dashboard.project.detail')->with(compact("team","progress","percentage","project"));
        }
    }

    public function detailProgress($teamID, $projectID, $progressID) {
        $team       = TeamApprentice::where("status_hired","DI TERIMA")->where("id",$teamID)->first();
        $progress   = ProgressProject::with("valuation")->where("id",$progressID)->where("project_id", $projectID)->first();

        if($team == NULL || $projectID == NULL){
            return redirect("project");
        }

        return view('pages.dashboard.project.progress.detail')->with(compact("team","progress"));
    }

    public function change($teamID, $projectID, $progressID) {
        $progress       = ProgressProject::where("id",$progressID)->where("project_id", $projectID)->first();
        $teamID         = $teamID;

        if($progress != NULL) {
            if($this->isApprentice) {
                if($this->status_hired == "DI TOLAK" ||$this->status_hired == "SEDANG DIPROSES") {
                    return response(abort('403'));
                } else {
                    return view('pages.dashboard.project.progress.update')->with(compact("progress","teamID"));
                }
            } else {
                return view('pages.dashboard.project.progress.update')->with(compact("progress","teamID"));
            }
        } else {
            return redirect("project");
        }
    }

    public function remove($teamID, $projectID, $progressID) {
        $delete     = ProgressProject::where('id',$progressID)->where("project_id", $projectID)->delete();

        if($this->isApprentice) {
            if($this->status_hired == "DI TOLAK" || $this->status_hired == "SEDANG DIPROSES") {
                return response(abort('403'));
            } else {
                if($delete) {
                   return redirect('/project/detail/'.$teamID)->with('message', 'Berhasil Menghapus Progress');
                } else {
                    return redirect('/project/detail/'.$teamID)->with('message', 'Gagal Menghapus Progress');
                }
            }
        }
        else {
            if($delete) {
                return redirect('/project/detail/'.$teamID)->with('message', 'Berhasil Menghapus Progress');
            } else {
                return redirect('/project/detail/'.$teamID)->with('message', 'Gagal Menghapus Progress');
            }
        }
    }
}

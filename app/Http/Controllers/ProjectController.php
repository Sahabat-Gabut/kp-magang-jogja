<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{TeamApprentice,ProgressProject,Project};

class ProjectController extends Controller
{
    public function index() 
    { 
        $team = TeamApprentice::where("status_hired","DI TERIMA")->get();
        
        if(isset(Auth::user()->apprenticeTeam))
        {
            if(Auth::user()->apprenticeTeam->status_hired == "DI TOLAK" || 
               Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES")
            {
                return response(abort('403'));
            }
            else 
            {
                return view("pages.dashboard.project.index")->with(compact('team'));
            }
        }
        else 
        {
            return view("pages.dashboard.project.index")->with(compact('team'));
        }

    }

    public function detail($id){
        $team       = TeamApprentice::with(["apprenticeProject"])->where("status_hired","DI TERIMA")->where("id",$id)->get();
        $progress   = ProgressProject::where("project_id",$team[0]->apprenticeProject->id)->get();
        $countProgress = ProgressProject::with(["project"])->where("project_id", $team[0]->apprenticeProject->id)->count();
        $done       = ProgressProject::with(["project"])->where("project_id", $team[0]->apprenticeProject->id)->where("status","SELESAI")->count();
        
        if($countProgress <= 0){
            $percentage = 0;
        } else {
            $percentage = number_format($done/$countProgress*100);
        }

        if(isset(Auth::user()->apprenticeTeam))
        {
            if(Auth::user()->apprenticeTeam->status_hired == "DI TOLAK" || 
               Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES")
            {
                return response(abort('403'));
            }
            else 
            {
                return view('pages.dashboard.project.detail_project')->with(compact("team","progress","percentage"));
            }
        }
        else 
        {
            return view('pages.dashboard.project.detail_project')->with(compact("team","progress","percentage"));
        }
    }

    public function change($projectID, $progressID)
    {
        $progress   = ProgressProject::where("id",$progressID)->get();
        $teamID     = $projectID;
        
        if(isset(Auth::user()->apprenticeTeam))
        {
            if(Auth::user()->apprenticeTeam->status_hired == "DI TOLAK" || 
               Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES")
            {
                return response(abort('403'));
            }
            else 
            {
                return view('pages.dashboard.project.change_progress')->with(compact("progress","teamID"));
            }
        }
        else 
        {
            return view('pages.dashboard.project.change_progress')->with(compact("progress","teamID"));
        }
    }

    public function remove($teamID, $progressID)
    {
        $progress   = ProgressProject::where("id",$progressID)->get();
        $delete     = ProgressProject::where('id',$progressID)->delete();

        if(isset(Auth::user()->apprenticeTeam))
        {
            if(Auth::user()->apprenticeTeam->status_hired == "DI TOLAK" || 
               Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES")
            {
                return response(abort('403'));
            }
            else 
            {
                if($delete)
                {
                   return redirect('/project/detail/'.$teamID)->with('message', 'Berhasil Menghapus Progress');
                }
                else
                {
                    return redirect('/project/detail/'.$teamID)->with('message', 'Gagal Menghapus Progress');
                }
            }
        }
        else 
        {
            if($delete)
            {

                return redirect('/project/detail/'.$teamID)->with('message', 'Berhasil Menghapus Progress');
            }
            else
            {
                return redirect('/project/detail/'.$teamID)->with('message', 'Gagal Menghapus Progress');
            }
        }
    }
}

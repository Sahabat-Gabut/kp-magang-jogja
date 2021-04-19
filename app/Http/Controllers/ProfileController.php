<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Apprentice,Admin,TeamApprentice};

class ProfileController extends Controller
{
    public $team;
    public function index()
    {
        $apprentice    = Apprentice::with("jss")->where("jss_id",\Auth::user()->id)->get();
        $admin         = Admin::with("jss")->where("jss_id",\Auth::user()->id)->get();
        $name          = implode(' ', array_slice(explode(' ', \Auth::user()->fullname), 0, 2));
        if(\Auth::user()->apprenticeDetail){
            $this->team          = TeamApprentice::with("project")->where("id",$apprentice[0]->team_apprentice_id)->get();
        }
        $team = $this->team;

        return view('pages.dashboard.profile.index')->with(compact("apprentice","admin","name","team"));
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Attendance, TeamApprentice};
use Livewire\WithPagination;

class AttendanceShow extends Component
{
    use WithPagination;
    public $projects, $selectProjects, $attendance;

    public function render()
    {
        if(!\Auth::user()->adminDetail) {
            $this->projects     = \DB::table('apprentice')
                                    ->join('team_apprentice','team_apprentice.id','=','apprentice.team_apprentice_id')
                                    ->join('project','project.team_apprentice_id','=','team_apprentice.id')
                                    ->where('jss_id', \Auth::user()->id)
                                    ->where('status_hired','DI TERIMA')
                                    ->select('project.name_project','project.id as project_id', 'team_apprentice.id as team_id','apprentice.id')
                                    ->get();
            if(!$this->selectProjects){
                $this->selectProjects = $this->projects[0]->project_id;
            }
    
            $apprentice         = \DB::table('apprentice')
                                ->join('team_apprentice','team_apprentice.id','=','apprentice.team_apprentice_id')
                                ->join('project','project.team_apprentice_id','=','team_apprentice.id')
                                ->where('project.id',$this->selectProjects)
                                ->select('apprentice.id')
                                ->first();
        }else {
            $this->attendance = TeamApprentice::all();
        }

        return view('livewire.attendance-show',[
            'attendance2' => Attendance::where('apprentice_id',isset($apprentice->id))
                                        ->orderBy('start_attendace', 'asc')
                                        ->paginate(5)
        ]);

    }
}

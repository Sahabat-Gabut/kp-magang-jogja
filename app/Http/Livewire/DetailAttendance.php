<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{TeamApprentice,Apprentice};

class DetailAttendance extends Component
{
    public $apprentice, $searchTerm, $selectApprentice, $select, $team_id;

    public function mount($data, $select)
    {
        $this->apprentice = $data;
        $this->select = $select;
        $this->team_id = $data[0]->team_apprentice_id;
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $apprentice = $this->selectApprentice;
        // // $this->submission = Apprentice::where('university','like',$searchTerm)->get();
        if($this->selectApprentice != null) {
            $this->apprentice = \DB::table('apprentice')
                                    ->join('attendance', 'apprentice.id', '=', 'attendance.apprentice_id')
                                    ->join('jss', 'apprentice.jss_id', '=', 'jss.id')
                                    ->where('apprentice.id', $this->selectApprentice)
                                    ->select('apprentice.*', 'attendance.id as attendance_id', 'attendance.*', 'jss.*')
                                    ->get();
            // Apprentice::where('id',$this->selectApprentice)->get();
        }else {
            $this->apprentice =  \DB::table('apprentice')
                                    ->join('attendance', 'apprentice.id', '=', 'attendance.apprentice_id')
                                    ->join('jss', 'apprentice.jss_id', '=', 'jss.id')
                                    ->where('team_apprentice_id', $this->team_id)
                                    ->orderBy('attendance.start_attendace', 'asc')
                                    ->select('apprentice.*', 'attendance.id as attendance_id', 'attendance.*', 'jss.*')
                                    ->get();
            // Apprentice::where('team_apprentice_id',$this->team_id)->get();
        }
        return view('livewire.detail-attendance');
    }
}

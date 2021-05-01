<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{TeamApprentice,Apprentice};

class DetailAttendance extends Component
{
    public $attendance, $selectApprentice, $apprentice, $team_id;

    public function mount($data, $select)
    {
        $this->attendance   = $data;
        $this->apprentice   = $select;
        $this->team_id      = $data[0]->team_apprentice_id;
    }

    public function render()
    {
        if($this->selectApprentice != null) {
            $this->attendance = \DB::table("apprentice")
                                    ->join("attendance", "apprentice.id", '=', "attendance.apprentice_id")
                                    ->join("jss", "apprentice.jss_id", '=', "jss.id")
                                    ->where("apprentice.id", $this->selectApprentice)
                                    ->select("apprentice.*", "attendance.id as attendance_id", "attendance.*", "jss.*")
                                    ->get();
        }else {
            $this->attendance =  \DB::table('apprentice')
                                    ->join('attendance', 'apprentice.id', '=', 'attendance.apprentice_id')
                                    ->join('jss', 'apprentice.jss_id', '=', 'jss.id')
                                    ->where('team_apprentice_id', $this->team_id)
                                    ->orderBy('attendance.start_attendace', 'asc')
                                    ->select('apprentice.*', 'attendance.id as attendance_id', 'attendance.*', 'jss.*')
                                    ->get();
        }
        return view('livewire.detail-attendance');
    }
}

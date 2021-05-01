<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{TeamApprentice,Apprentice};
use Livewire\WithPagination;

class AttendanceDetail extends Component
{
    use WithPagination;
    public $selectApprentice, $apprentice, $team_id, $availableData;

    public function mount($data, $select)
    {
        $this->apprentice   = $select;
        $this->team_id      = $data[0]->team_apprentice_id;
        $this->availableData = 5;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $availableData = $this->availableData;
        return view('livewire.attendance-detail',[
            "attendance"    => Apprentice::join('attendance', 'apprentice.id', '=', 'attendance.apprentice_id')
                                        ->join('jss', 'apprentice.jss_id', '=', 'jss.id')
                                        ->where('team_apprentice_id', $this->team_id)
                                        ->where("apprentice.id", 'like', '%'.$this->selectApprentice.'%')
                                        ->orderBy('attendance.start_attendace', 'asc')
                                        ->select('apprentice.*', 'attendance.id as attendance_id', 'attendance.*', 'jss.*')
                                        ->paginate($availableData)
        ]);
    }
}

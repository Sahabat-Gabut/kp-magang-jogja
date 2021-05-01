<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AttendanceUpdate extends Component
{
    public $attendance_id, $status, $team_id, $index;

    public function mount($data, $index)
    {
        $this->attendance_id= $data->attendance_id;
        $this->status       = $data->status;
        $this->team_id      = $data->team_apprentice_id;
        $this->index        = $index;
    }

    public function render()
    {
        return view('livewire.attendance-update');
    }

    public function store()
    {
        $update = \DB::table('attendance')
                    ->where('id', $this->attendance_id)
                    ->update(['status' => $this->status]);
        
        if($update){
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', 'Status Berhasil Diperbaharui');
            return redirect()->to('/attendance/detail/'.$this->team_id);
        }else{
            session()->flash('gagal', 'gagal');
            session()->flash('title', 'Gagal');
            session()->flash('message', 'Gagal');
            return redirect()->to('/attendance/detail/'.$this->team_id);
        }
    }
}

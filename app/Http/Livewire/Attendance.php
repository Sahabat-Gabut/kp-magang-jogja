<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use DB;

class Attendance extends Component
{
    public $status, $attendance, $index;

    public function mount($attendance, $index)
    {
        $this->attendance = $attendance;
        $this->index = $index;
    }

    public function render()
    {
        date_default_timezone_set("Asia/Jakarta");
        return view('livewire.attendance');
    }

    public function store()
    {
        date_default_timezone_set("Asia/Jakarta");
        if($this->status == "HADIR") {
            if(date("Y-m-d h:i:s") > $this->attendance->end_attendace) {
                $this->status = "TELAT";
            } else {
                $this->status = "TEPAT WAKTU";
            }
        }
        $update = DB::table('attendance')
                            ->where('id', $this->attendance->id)
                            ->update(['status' => $this->status]);
        
        if($update){
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', 'Status Berhasil Diperbaharui');
            return redirect()->to('/attendance');
        }else{
            session()->flash('gagal', 'gagal');
            session()->flash('title', 'Gagal');
            session()->flash('message', 'Gagal');
        }
    }
}

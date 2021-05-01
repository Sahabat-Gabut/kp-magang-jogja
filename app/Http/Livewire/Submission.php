<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{TeamApprentice,Apprentice,Agency};

class Submission extends Component
{
    public $submission, $apprentice, $searchTerm, $status, $quota;

    public function mount($submission)
    {
        if(\Auth::user()->adminRole->id != "1") {
            $agency           = Agency::find(\Auth::user()->adminDetail->agency_id);
            $this->quota      = $agency->quota; 
        }
        $this->submission = $submission;
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $status = '%'.$this->status.'%';
        $this->submission = TeamApprentice::with(['apprentices','agencyDetail'])->where('university','like',$searchTerm)->get();
        $this->submission = TeamApprentice::with(['apprentices','agencyDetail'])->where('status_hired','like',$status)->get();
        return view('livewire.submission');
    }

    public function addQuota()
    {
        $insert = Agency::where("id", \Auth::user()->adminDetail->agency_id)
                        ->update(["quota" => $this->quota]);

        if($insert) {
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', "Berhasil menambahkan kuota");
            return redirect("submission");
        }else {
            session()->flash('errors', 'errors');
            session()->flash('title', 'Gagal');
            session()->flash('message', "Gagal menambahkan kuota");
            return redirect("submission");
        }
    }
}

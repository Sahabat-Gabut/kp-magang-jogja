<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{TeamApprentice,Apprentice};

class Submission extends Component
{
    public $submission, $apprentice, $searchTerm, $status;

    public function mount($submission)
    {
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
}

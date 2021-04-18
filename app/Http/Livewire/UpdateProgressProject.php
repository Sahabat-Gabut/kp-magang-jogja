<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProgressProject;
use Livewire\WithFileUploads;

class UpdateProgressProject extends Component
{
    use WithFileUploads;
    public $progress, $status, $explanation, $file, $teamid;

    public function mount($data, $id)
    {
        $this->progress = $data;
        $this->status   = $data[0]->status;
        $this->explanation= $data[0]->explanation;
        $this->file     = $data[0]->file;
        $this->teamid   = $id;
    }

    public function render()
    {
        return view('livewire.update-progress-project');
    }

    public function store()
    {
        $validationData = $this->validate(
        [
            'status'            => 'required',
            'explanation'       => 'required',
        ],
        [
            'status.required' => 'Progres Harus diisi!',
            'explanation.required' => 'Deskripsi Harus diisi!',
        ]);

        if($this->file != $this->progress[0]->file) {
            $validationData["file"]     = $this->file->store('files','public');
            ProgressProject::where('id', $this->progress[0]->id)
                            ->update([
                                'status'        => $this->status,
                                'explanation'   => $this->explanation,
                                'file'          => "/storage/".$validationData["file"]
                            ]);
        } else {
            ProgressProject::where('id', $this->progress[0]->id)
                            ->update([
                                'status'        => $this->status,
                                'explanation'   => $this->explanation
                            ]);
        }


        $this->redirect('/project/detail/'.$this->teamid); 
    }
}

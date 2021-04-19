<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProgressProject;
use Livewire\WithFileUploads;
use App\Models\Apprentice;

class UpdateProgressProject extends Component
{
    use WithFileUploads;
    public $name, $progress, $apprentice, $status, $explanation, $file, $teamid, $user;

    public function mount($data, $id)
    {
        $this->progress = $data;
        $this->apprentice = $data[0]->apprentice_id;
        $this->name     = $data[0]->name;
        $this->status   = $data[0]->status;
        $this->explanation= $data[0]->explanation;
        $this->file     = $data[0]->file;
        $this->teamid   = $id;
        $this->user     = Apprentice::where('team_apprentice_id',$id)->with('jss')->get();
    }

    public function render()
    {
        return view('livewire.update-progress-project');
    }

    public function store()
    {
        $validationData = $this->validate(
        [
            'apprentice'        => 'required',
            'user'              => 'required',
            'status'            => 'required',
            'explanation'       => 'required',
        ],
        [
            'apprentice.required'=> 'Planning Harus diisi!',
            'user.required'     => 'Penanggung Jawab Harus diisi!',
            'status.required'   => 'Progres Harus diisi!',
            'explanation.required' => 'Deskripsi Harus diisi!',
        ]);

        if($this->file != $this->progress[0]->file) {
            $validationData["file"]     = $this->file->store('files','public');
            ProgressProject::where('id', $this->progress[0]->id)
                            ->update([
                                'apprentice_id'=> $this->apprentice,
                                'name'          => $this->name,
                                'status'        => $this->status,
                                'explanation'   => $this->explanation,
                                'file'          => "/storage/".$validationData["file"]
                            ]);
        } else {
            ProgressProject::where('id', $this->progress[0]->id)
                            ->update([
                                'apprentice_id'=> $this->apprentice,
                                'name'          => $this->name,
                                'status'        => $this->status,
                                'explanation'   => $this->explanation
                            ]);
        }


        $this->redirect('/project/detail/'.$this->teamid); 
    }
}

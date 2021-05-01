<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProgressProject;
use Livewire\WithFileUploads;
use App\Models\Apprentice;

class ProgressProjectUpdate extends Component
{
    use WithFileUploads;
    public $name, $progress, $apprentice, $status, $explanation, $file, $teamid, $user;

    public function mount($data, $id)
    {
        $this->progress = $data;
        $this->apprentice = $data->apprentice_id;
        $this->name     = $data->name;
        $this->status   = $data->status;
        $this->explanation= $data->explanation;
        $this->file     = $data->file;
        $this->teamid   = $id;
        $this->user     = Apprentice::where('team_apprentice_id',$id)->with('jss')->get();
    }

    public function render()
    {
        return view('livewire.progress-project-update');
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

        if($this->file != $this->progress->file) {
            $validationData["file"]     = $this->file->store('files','public');
            ProgressProject::where('id', $this->progress->id)
                            ->update([
                                'apprentice_id'=> $this->apprentice,
                                'name'          => $this->name,
                                'status'        => $this->status,
                                'explanation'   => $this->explanation,
                                'file'          => "/storage/".$validationData["file"]
                            ]);
        } else {
            ProgressProject::where('id', $this->progress->id)
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

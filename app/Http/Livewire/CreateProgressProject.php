<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{ProgressProject,Apprentice};

class CreateProgressProject extends Component
{
    public $name, $project_id, $team_id, $user, $apprentice;

    public function mount($id, $teamid)
    {
        $this->project_id = $id;
        $this->team_id = $teamid;
        $this->user = Apprentice::where('team_apprentice_id',$teamid)->with('jss')->get();
    }

    public function render()
    {
        return view('livewire.create-progress-project');
    }

    public function store()
    {
        
        $validationData = $this->validate(
        [
            'name'    => 'required',
            'apprentice' => 'required'
        ],
        [
            'name.required' => 'Planning Harus diisi!',
            'apprentice.required' => 'Penanggung Harus diisi!'
        ]);

        ProgressProject::create([
            'project_id'    => $this->project_id,
            'apprentice_id' => $this->apprentice,
            'name'          => $this->name
        ]);

        $this->redirect('/project/detail/'.$this->team_id); 
    }

}

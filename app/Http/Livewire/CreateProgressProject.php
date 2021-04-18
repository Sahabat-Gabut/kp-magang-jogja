<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProgressProject;

class CreateProgressProject extends Component
{
    public $name, $project_id, $team_id;

    public function mount($id, $teamid)
    {
        $this->project_id = $id;
        $this->team_id = $teamid;
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
        ],
        [
            'name.required' => 'Planning Harus diisi!'
        ]);

        ProgressProject::create([
            'project_id'    => $this->project_id,
            'name'          => $this->name
        ]);

        $this->redirect('/project/detail/'.$this->team_id); 
    }

}

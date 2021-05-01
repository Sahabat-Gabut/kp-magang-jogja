<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Apprentice, Valuation};

class ValuationCreate extends Component
{
    public $name, $project_id, $team_id, $user, $apprentice, $progress, $score, $explanation;

    public function mount($id, $teamid, $progress) {
        $this->project_id = $id;
        $this->team_id = $teamid;
        $this->user = Apprentice::where('team_apprentice_id',$teamid)->with('jss')->get();
        $this->progress = $progress;
    }

    public function render() {
        return view('livewire.valuation-create');
    }

    public function store() {
        $validationData = $this->validate([
            'score'       => 'required',
            'explanation' => 'required'
        ],
        [
            'score.required'      => 'Nilai harus diisi!',
            'explanation.required'=> 'Komentar harus diisi!'
        ]);

        Valuation::create([
            'progress_project_id'   => $this->progress->id,
            'score'                 => $this->score,
            'explanation'           => $this->explanation
        ]);

        return redirect()->to('project/detail/'.$this->project_id); 
    }
}

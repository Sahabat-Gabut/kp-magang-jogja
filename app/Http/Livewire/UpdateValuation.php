<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Apprentice, Valuation};

class UpdateValuation extends Component
{
    public $project_id, $valuation_id, $score, $explanation;

    public function mount($valuation, $id) {
        $this->project_id   = $id;
        $this->valuation_id = $valuation->id;
        $this->score        = $valuation->score;
        $this->explanation  = $valuation->explanation;
    }

    public function render()
    {
        return view('livewire.update-valuation');
    }

    public function store() {
        $validationData = $this->validate([
            'score'       => 'required',
            'explanation' => 'required'
        ],
        [
            'score.required'        => 'Nilai harus diisi!',
            'explanation.required'  => 'Komentar harus diisi!'
        ]);

        $update = Valuation::where("id",$this->valuation_id)->update([
            'score'                 => $this->score,
            'explanation'           => $this->explanation
        ]);
        if($update) {
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', 'Nilai berhasil diperbaharui');
            return redirect()->to('project/detail/'.$this->project_id); 
        } else {
            session()->flash('error', 'error');
            session()->flash('title', 'Gagagl');
            session()->flash('message', 'Gagal memperbarui nilai');
            return redirect()->to('project/detail/'.$this->project_id); 
        }
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agency;

class UpdateAgency extends Component
{
    public $idAgency, $name, $location;

    public function mount($data)
    {
        $this->idAgency = $data->id;
        $this->name   = $data->name;
        $this->location = $data->location;
    }

    public function render()
    {
        return view('livewire.update-agency');
    }

    public function store()
    {
       $update =  Agency::where('id', $this->idAgency)
                            ->update([
                                'name'          => $this->name,
                                'location'      => $this->location
                            ]);

        if($update){
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', 'Dinas berhasil diperbaharui');
            return redirect()->to('/agency');
        }
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agency;

class UpdateAgency extends Component
{
    public $idAgency, $name, $location, $quota;

    public function mount($data)
    {
        $this->idAgency = $data->id;
        $this->name     = $data->name;
        $this->location = $data->location;
        $this->quota    = $data->quota;
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
                                'location'      => $this->location,
                                'quota'         => $this->quota
                            ]);

        if($update){
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', 'Dinas berhasil diperbaharui');
            return redirect()->to('/agency');
        }
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agency;

class AgencyShow extends Component
{
    public $agency, $searchTerm;

    public function mount()
    {
        $this->agency = Agency::all();
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $this->agency = Agency::where('name','like',$searchTerm)->get();
    
        return view('livewire.agency-show');
    }
}

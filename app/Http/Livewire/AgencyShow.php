<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agency;
use Livewire\WithPagination;

class AgencyShow extends Component
{
    use WithPagination;
    public $searchTerm, $availableData;

    public function mount()
    {
        $this->availableData = 5;
    }

    public function render()
    {    
        return view('livewire.agency-show',[
            "agency"    => Agency::where('name','like','%'.$this->searchTerm.'%')->paginate($this->availableData)
        ]);
    }
}

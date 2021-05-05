<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agency;
use Livewire\WithPagination;

class AgencyShowQuota extends Component
{
    use WithPagination;
    public $searchTerm;

    public function render()
    {
        return view('livewire.agency-show-quota',[
            'agency'    => Agency::where('name','like','%'.$this->searchTerm.'%')->paginate(10)
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{TeamApprentice,Apprentice,Agency};
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class SubmissionShow extends Component
{
    use WithPagination;
    public $apprentice, $searchTerm, $status, $quota, $agency, $selectAgency, $availableData;

    public function mount()
    {
        if(Auth::user()->adminRole->id != "1") {
            $agency           = Agency::find(Auth::user()->adminDetail->agency_id);
            $this->quota      = $agency->quota; 
        }
        $this->agency = Agency::all(); 
        $this->availableData = 5;
    }

    public function render()
    {
        
        if($this->selectAgency == "Dinas") {
            $selectAgency = "%%";
        } else {
            $selectAgency = '%'.$this->selectAgency.'%';
        }

        if(Auth::user()->adminRole->id == '1') {
            return view('livewire.submission-show',[
                "submission"    => TeamApprentice::with(['apprentices','agency'])
                                                 ->where('status_hired',"like",'%'.$this->status.'%')
                                                 ->where('agency_id','like',$selectAgency)
                                                 ->paginate($this->availableData)
            ]);
        }else {
            return view('livewire.submission-show',[
                "submission"    => TeamApprentice::with(['apprentices','agency'])
                                                 ->where('status_hired',"like",'%'.$this->status.'%')
                                                 ->where('agency_id','like',Auth::user()->adminDetail->agency_id)
                                                 ->paginate($this->availableData)
            ]);
        }
    }

    public function addQuota()
    {
        $insert = Agency::where("id", Auth::user()->adminDetail->agency_id)
                        ->update(["quota" => $this->quota]);

        if($insert) {
            session()->flash('success', 'success');
            session()->flash('title', 'Berhasil');
            session()->flash('message', "Berhasil menambahkan kuota");
            return redirect("submission");
        }else {
            session()->flash('errors', 'errors');
            session()->flash('title', 'Gagal');
            session()->flash('message', "Gagal menambahkan kuota");
            return redirect("submission");
        }
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{RoleAdmin, Agency, Admin};

class CreateAdmin extends Component
{
    public $idjss, $idrole, $role, $idagency, $agency;

    public function mount() {
        $this->role   = RoleAdmin::all();
        $this->agency = Agency::all();
    }

    public function render() {
        if($this->idrole == "1") {
            $this->idagency = "1";
        }
        return view('livewire.create-admin');
    }

    public function store()
    {
        
        $validationData = $this->validate(
        [
            'idjss'       => 'required',
            'idrole'      => 'required',
            'idagency'    => 'required',
        ],
        [
            'idjss.required'      => 'ID JSS Harus diisi!',
            'idrole.required'     => 'Role Harus diisi!',
            'idagency.required'   => 'Dinas Harus diisi!'
        ]);

        if($this->idrole == "1") {
            $this->idagency = NULL;
        }

        Admin::create([
            'role_admin_id' => $this->idrole,
            'jss_id'        => $this->idjss,
            'agency_id '    => $this->idagency
        ]);

        $this->redirect('admin'); 
    }
}

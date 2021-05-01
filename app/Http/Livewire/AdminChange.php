<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin;

class AdminChange extends Component
{
    public $idjss, $idadmin, $idrole, $role, $idagency, $agency, $admin;

    public function mount($idadmin, $role)
    {
        $admin = Admin::find($idadmin);
        $this->idadmin  = $idadmin; 
        $this->admin    = $admin;
        $this->role     = $role;
        $this->idjss    = "JSS-I".$admin->jss_id;
        $this->idrole   = $admin->role_admin_id;
        $this->idagency = $admin->agency_id;
    }
    
    public function render()
    {
        return view('livewire.admin-change');
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

        $update = Admin::where('id',$this->idadmin)
                        ->update([
                            "jss_id"       => \str_replace("JSS-I","",$this->idjss),
                            "role_admin_id"=> $this->idrole,
                            "agency_id"    => $this->idagency
                        ]);

        if($update) {
            return $this->success("Admin berhasil dirubah");
        }else {
            return $this->errors("Gagal merubah admin");
        }
 
    }

    public function success($message)
    {
        session()->flash('success', 'success');
        session()->flash('title', 'Berhasil');
        session()->flash('message', $message);
        return redirect("admin");
    }

    public function errors($message)
    {
        session()->flash('errors', 'errors');
        session()->flash('title', 'Gagal');
        session()->flash('message', $message);
        return redirect("admin");
    }
}

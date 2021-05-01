<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{RoleAdmin, Agency, Admin};

class AdminShow extends Component
{
    public $idjss, $idrole, $role, $idagency, $agency, $admin, $searchTerm;

    public function mount($admin) {
        $this->role   = RoleAdmin::all();
        $this->agency = Agency::all();
        $this->admin  = $admin;

        if(\Auth::user()->adminRole->id != "1") {
            unset($this->role[0]);
        }
    }

    public function render() {
        if($this->idrole == "1") {
            $this->idagency = "1";
        }

        $searchTerm = '%'.$this->searchTerm.'%';
        if(\Auth::user()->adminRole->id == "1") {
            $this->admin = \DB::table('admin')
                              ->join('jss', 'admin.jss_id', '=', 'jss.id')
                              ->join('role_admin','admin.role_admin_id','=','role_admin.id')
                              ->where('fullname','like', $searchTerm)
                              ->select('admin.*','jss.*','role_admin.*')
                              ->get();
        }else {
            $this->admin = \DB::table('admin')
                              ->join('jss', 'admin.jss_id', '=', 'jss.id')
                              ->join('role_admin','admin.role_admin_id','=','role_admin.id')
                              ->where("agency_id", \Auth::user()->adminDetail->agency_id)
                              ->where('fullname','like', $searchTerm)
                              ->select('admin.*','jss.*','role_admin.*')
                              ->get();
        }
        return view('livewire.admin-show');
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

        if($update) {
            return $this->success("Berhasil menambahkan admin");
        }else {
            return $this->errors("Gagal menambahkan admin");
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

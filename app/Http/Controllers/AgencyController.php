<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;

class AgencyController extends Controller
{
    public function index() {
        $agency = Agency::all();
        return view("pages.dashboard.agency.index")->with(compact("agency"));
    }

    public function detail($id) {
        $agency = Agency::find($id);
        return view("pages.dashboard.agency.detail")->with(compact("agency"));
    }

    public function update($id) {
        $agency = Agency::find($id);
        return view("pages.dashboard.agency.update")->with(compact("agency"));
    }

    public function delete($id) {
        $delete = Agency::find($id)->delete();
        $agency = Agency::all();

        if($delete) {
            return redirect()->route('agency')->with('message', 'Berhasil Menghapus Dinas');
        }else {
            return redirect()->route('agency')->with('message', 'Gagal Menghapus Dinas');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index() {
        if(Auth::user()->apprenticeTeam) {
            return response(abort(403));
        }else {
            if(Auth::user()->adminRole->id == "3") {
                return response(abort(403));
            } else {
                if(Auth::user()->adminRole->id == "1") {
                    $admin = Admin::all();
                    return view("pages.dashboard.admin.index")->with(compact("admin"));
                }else {
                    $admin = Admin::where("agency_id", Auth::user()->adminDetail->agency_id)->get();
                    return view("pages.dashboard.admin.index")->with(compact("admin"));
                }
            }
        }
    }

    public function detail($id) {
        $admin = Admin::find($id);
        return view("pages.dashboard.admin.detail")->with(compact("admin"));
    }

    public function update($id) {
        $admin = Admin::find($id);
        return view("pages.dashboard.admin.update")->with(compact("admin"));
    }

    public function delete($id) {
        $delete = Admin::find($id)->delete();
        $admin = Admin::all();

        if($delete) {
            return redirect()->route('admin')->with('message', 'Berhasil Menghapus Admin');
        }else {
            return redirect()->route('admin')->with('message', 'Gagal Menghapus Admin');
        }
    }
}

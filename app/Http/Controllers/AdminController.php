<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public $isAdmin, $isSuperAdmin, $isModerator, $isApprentice;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check() ) {
                $this->isApprentice       = isset(Auth::user()->apprenticeTeam);
                $this->isSuperAdmin       = isset(Auth::user()->adminRole->id) == "1";
                $this->isModerator        = Auth::user()->adminRole->id == "3";
            }
           return $next($request);
       });

    }

    public function index() {
        if($this->isApprentice) { return response(abort(403)); }
        else {
            if($this->isModerator) { return response(abort(403)); }
            else {
                if($this->isSuperAdmin) {
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

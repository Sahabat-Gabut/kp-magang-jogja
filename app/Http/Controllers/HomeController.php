<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{

    public function index()
    {
        if(isset(Auth::user()->adminRole)) {
            return redirect()->route('dashboard');
        } else {
            return view('pages.guest.index');
        }

    }
}

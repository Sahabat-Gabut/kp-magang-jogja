<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{

    public function index()
    {
        $title = 'Magang Jogja';
        return Inertia::render('Index', compact('title'));
    }
}

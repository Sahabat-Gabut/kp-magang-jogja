<?php

namespace App\Http\Controllers;

use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{
    protected $isAdmin, $isSuperAdmin, $isAdminFromAgency, $apprentice, $agency;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check() ) {
                $this->auth               = Auth::user();
                $this->isAdmin            = $this->auth->load(['admin.role','admin.agency']);
                $this->isSuperAdmin       = isset($this->isAdmin->admin->role->id) == "1";
                $this->isAdminFromAgency  = isset($this->isAdmin->admin->agency->id) == $request->agency_id;
            }
           return $next($request);
       });
    }

    public function store(Request $request)
    {
        $insert = Validation::insert([
            'admin_id'         => $this->user->admin->id,
            'team_id'          => '',
            'agency_id'        => '',
            'result_date'      => '',
            'start_date'       => '',
            'field_supervisor' => '',
            'response_letter'  => '',
            'finish'           => ''
        ]);

        if($insert) {

        } else {

        }
    }
}

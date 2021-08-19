<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function showPDF(Team $team): Response
    {
        $team = $team->with(['apprentices.jss', 'project.progress.jss', 'agency', 'admin.jss'])
            ->first();
        return Inertia::render('generatePDF', compact(['team']));
    }
}

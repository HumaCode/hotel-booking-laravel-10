<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function allTeam()
    {
        $teams = Team::latest()->get();

        return view('backend.team.all_team', compact('teams'));
    }
}

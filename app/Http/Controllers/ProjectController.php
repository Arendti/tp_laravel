<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Project;

class ProjectController extends Controller
{
    public function projects()
    {
        $user = auth()->user();
        if ($user->role == 'Admin'){
            $projects = Project::all();
        }
        elseif ($user->role == 'Dev'){
            $projects = $user->projects;
        }

        $tickets = [];
        foreach ($projects as $project){
            $tickets[$project->project_title] = $project->tickets;
        }

        return view('projects.projects', [
            "projects" => $projects, 
            "tickets" => $tickets,
        ]);
    }
}

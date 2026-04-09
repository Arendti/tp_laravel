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
    
    public function new_project()
    {
        $user = auth()->user();
        if ($user->role == 'Admin'){
            $devs = User::where('role', 'Dev')->get();
        }
        elseif ($user->role == 'Dev'){
            $devs = User::where('id', $user->id)->get();
        }

        $clients = User::where('role', 'Client')->get();

        return view('projects.new_project', [
            "devs" => $devs,
            "clients" => $clients,
        ]);
    }

    public function show($id)
    {
        $project = Project::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !in_array($user, $project->devs()) && $user != $project->client()){
            return redirect()->route('projects');
        }

        $isAssigned = $project->isAssigned();
        $devs = $project->devs();
        $length = $project->length();
        $tickets = $project->tickets;

        return view('projects.show', [
            "project" => $project,
            "isAssigned" => $isAssigned,
            "devs" => $devs,
            "length" => $length,
            "tickets" => $tickets,
        ]);
    }
}

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
        elseif ($user->role == 'Client'){
            $projects = Project::where('client_id', $user->id)->get();
        }
        else {
            $projects = collect();
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
        else {
            return redirect()->route('projects');
        }

        $clients = User::where('role', 'Client')->get();

        return view('projects.new_project', [
            "devs" => $devs,
            "clients" => $clients,
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Project_Name' => ['required', 'string', 'max:255'],
            'Project_Description' => ['required', 'string'],
            'Included_Hours' => ['required', 'integer', 'min:0'],
            'Hourly_Rate' => ['required', 'numeric', 'min:0'],
            'Start_Date' => ['required', 'date'],
            'End_Date' => ['required', 'date', 'after:Start_Date'],
            'Dev_ID' => ['required', 'integer'],
            'Client_ID' => ['required', 'integer'],
        ]);

        $project = Project::create([
            'client_id' => $validated['Client_ID'],
            'project_title' => $validated['Project_Name'],
            'project_description' => $validated['Project_Description'],
            'included_hours' => $validated['Included_Hours'],
            'hourly_rate' => $validated['Hourly_Rate'],
            'start_date' => $validated['Start_Date'],
            'end_date' => $validated['End_Date'],
        ]);

        $project->devs()->attach($validated['Dev_ID']); // Attach the selected developer

        return redirect()->route('projects');
    }

    public function show($id)
    {
        $project = Project::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$project->devs->contains($user) && $user->id != $project->client_id) {
            return redirect()->route('projects');
        }

        $isAssigned = $project->isAssigned();
        $devs = $project->devs;
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
    
    public function edit($id)
    {
        $project = Project::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$project->devs->contains($user) && $user->id != $project->client_id) {
            return redirect()->route('projects');
        }
        
        if ($user->role == 'Admin'){
            $devs = User::where('role', 'Dev')->get();
        }
        elseif ($user->role == 'Dev'){
            $devs = User::where('id', $user->id)->get();
        }
        
        $clients = User::where('role', 'Client')->get();

        return view('projects.edit', [
            "project" => $project,
            "devs" => $devs,
            "clients" => $clients,
        ]);
    }

    
    public function update(Request $request, $id)
    {

        $project = Project::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$project->devs->contains($user) && $user->id != $project->client_id) {
            return redirect()->route('projects');
        }

        $validated = $request->validate([
            'Project_Name' => ['required', 'string', 'max:255'],
            'Project_Description' => ['required', 'string'],
            'Included_Hours' => ['required', 'integer', 'min:0'],
            'Hourly_Rate' => ['required', 'numeric', 'min:0'],
            'Start_Date' => ['required', 'date'],
            'End_Date' => ['required', 'date', 'after:Start_Date'],
            'Dev_ID' => ['required', 'integer'],
            'Client_ID' => ['required', 'integer'],
        ]);

        $project->update([
            'client_id' => $validated['Client_ID'],
            'project_title' => $validated['Project_Name'],
            'project_description' => $validated['Project_Description'],
            'included_hours' => $validated['Included_Hours'],
            'hourly_rate' => $validated['Hourly_Rate'],
            'start_date' => $validated['Start_Date'],
            'end_date' => $validated['End_Date'],
        ]);
        
        $project->devs()->sync([$validated['Dev_ID']]);

        return redirect()->route('projects.show', $project->id);
    }


    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:tickets,id'],
        ]);

        $project = Project::findOrFail($validated['id']);

        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$project->devs->contains($user)){
            return redirect()->route('tickets');
        }

        $project->delete();

        return redirect()->route('projects');
    }
}

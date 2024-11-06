<?php

namespace App\Http\Controllers;


use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Log;


class ProjectsController extends Controller

{


    public function create()

    {

        // Get all users to display in the form

        $users = User::all(); // Fetch all users

        return view('projects.create', compact('users')); // Pass users to the view

    }

    // public function store(Request $request)
    // {
    //     // Validate the project and task data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'status' => 'required|in:aktiv,abgeschlossen,pausiert',
    //         'task_title' => 'required|string|max:255',
    //         'task_description' => 'nullable|string',
    //         'task_status' => 'required|in:neu,in_bearbeitung,abgeschlossen',
    //         'task_priority' => 'required|in:hoch,mittel,niedrig',
    //         'task_due_date' => 'required|date',
    //         'assigned_to' => 'required|exists:users,id', // Ensure assigned_to is a valid user ID
    //     ]);

    public function store(Request $request)
    {
        // Log the entire request data
        Log::info('Incoming request data:', $request->all());

        // Validate the project and task data
        $validatedData = $request->validate([



            // Project Data
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:aktiv,abgeschlossen,pausiert',

            // Task(s) Data
            'task_title' => 'required|array',
            'task_title.*' => 'required|string|max:255',
            'task_description' => 'nullable|array',
            'task_description.*' => 'nullable|string',
            'task_status' => 'required|array',
            'task_status.*' => 'required|in:neu,in_bearbeitung,abgeschlossen',
            'task_priority' => 'required|array',
            'task_priority.*' => 'required|in:hoch,mittel,niedrig',
            'task_due_date' => 'required|array',
            'task_due_date.*' => 'required|date',
            'assigned_to' => 'required|array',
            'assigned_to.*' => 'required|exists:users,id',
        ]);

        // Log the validated data
         Log::info('Validated data:', $validatedData);



        // Create the project
        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
        ]);

        // Create multiple tasks associated with the current project (1:n)
        foreach ($validatedData['task_title'] as $index => $title) {
            Task::create([
                'title' => $title,
                'description' => $validatedData['task_description'][$index] ?? null,
                'status' => $validatedData['task_status'][$index],
                'priority' => $validatedData['task_priority'][$index],
                'due_date' => $validatedData['task_due_date'][$index],
                // Associate task with the project
                'project_id' => $project->id,
                'assigned_to' => $validatedData['assigned_to'][$index],
                'created_by' => $request->user()->id,
            ]);
        }

        // Redirect the  user to the dashboard
        return redirect()->route('dashboard')->with('success', 'Project and tasks created successfully.');
    }
}

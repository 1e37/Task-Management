<?php

namespace App\Http\Controllers;


use App\Models\Project;
use App\Models\Task;
use App\Http\Controllers\ProjectsController;
use Illuminate\Http\Request;


class TasksController extends Controller

{


    public function storeTask(Request $request){

                // Validate the project and task data
                $validatedProjectData = $request->validate([

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

               // Create multiple tasks associated to the current project (1:n)
            foreach ($validatedProjectData['task_title'] as $index => $title) {
                Task::create([
                    'title' => $title,
                    'description' => $validatedData['task_description'][$index] ?? null,
                    'status' => $validatedProjectData['task_status'][$index],
                    'priority' => $validatedProjectData['task_priority'][$index],
                    'due_date' => $validatedProjectData['task_due_date'][$index],
                    // Associate task with the project
                    'project_id' => $project->id,
                    'assigned_to' => $validatedProjectData['assigned_to'][$index],
                    'created_by' => $request->user()->id, // Assuming you want to store who created the task
                ]);
            }
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;


// Import the model to query database
use App\Models\Project;

class DashboardController extends Controller
{


    public function index(): View

    {
        // Fetches All Projects Table data
        //$project = Project::all();

        // Data Fetching:
        // Count of open tasks
        $openTasksCount = Project::where('status', 'aktiv')->count();

        // Get active projects with descriptions
        $activeProjects = Project::where('status', 'aktiv')->get();

        // Count of due tasks
        $idletasks = Project::where('status', 'pausiert')->count();
        $dueTasks = Project::where('status', 'pausiert')->get(); // Get due tasks with descriptions

        // Pass data to view
        return view('dashboard.index', compact('openTasksCount', 'activeProjects', 'dueTasks', 'idletasks'));
    }

    // Return the create view
    public function createProjects()
    {
        return view('projects.create');
    }

}

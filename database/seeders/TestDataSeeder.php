<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use App\Models\Project;
use App\Models\Task;

// Carbon = DateTime Functions
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        // Fill the defined Users Model (fillable)
        $user = User::createOrFirst(
            ['email' => 'test@testtest.cc'],
            [
            'name'=> 'test',
            'password'=> Hash::make("test") ] );



        // Same with Projects Model (fillable)
        // put the active Projects in a variable to assign the task id based on relationship
        $activeProjects = Project::create([
            'name'=> 'Projekt1',
            'description'=> 'project1datafromseeder',
            'status' => 'aktiv'
        ]);

        // Create some idle projects
        Project::create([
            'name'=> 'Projectidle',
            'description'=> 'projectidle',
            'status' => 'pausiert'
        ]);

        // Craete the Task(s)
        // multichars how?
        Task::create([
            'title' => 'Seed Task 1',
            'description' => 'Seed Task 1',
            'status' => 'neu',
            'priority' => 'hoch',
            'due_date' => Carbon::now()->addDays(5),
            'project_id' => $activeProjects->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id,
        ]);

        Task::create([
            'title' => 'Seed Task 2',
            'description' => 'Seed Task 2',
            'status' => 'in_bearbeitung',
            'priority' => 'mittel',
            'due_date' => Carbon::now()->addDays(5),
            'project_id' => $activeProjects->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id,
        ]);

        Task::create([
            'title' => 'Seed Task 3',
            'description' => 'Seed Task 3',
            'status' => 'neu',
            'priority' => 'hoch',
            'due_date' => Carbon::now()->addDays(5),
            'project_id' => $activeProjects->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id,
        ]);

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'project_id',   // Include project_id for the relationship
        'assigned_to',   // Include assigned_to for the relationship
        'created_by',    // Include created_by for the relationship
    ];

    // Define the relationship between Task and Project
    // ( n:1 - multiple tasks can be part of one project)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Create 2 functions of the same table in order to keep track of task creator and assigner.

    // Define the relationship to the User who is assigned to the task
    public function assignedUser ()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Define the relationship to the User who created the task
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

// public function up(): void
// {
//     Schema::create('tasks', function (Blueprint $table) {
//         $table->id();
//         $table->string('title');
//         $table->text('description')->nullable();
//         $table->enum('status', ['neu', 'in_bearbeitung', 'abgeschlossen']);
//         $table->enum('priority', ['hoch', 'mittel', 'niedrig']);
//         $table->date('due_date');
//         $table->foreignId('project_id')->constrained()->onDelete('cascade');
//         $table->foreignId('assigned_to')->constrained('users');
//         $table->foreignId('created_by')->constrained('users');
//         $table->timestamps();
//     });

// }

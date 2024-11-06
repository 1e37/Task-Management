<?php

namespace App\Models;
//https://laravel.com/docs/5.0/eloquent
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    // Define a Database relation from projects to task
    // 1 Project contains n tasks
    public function tasks()
    {
        //->firstOrFail() will throw exception if model is not found
        return $this->hasMany(Task::class);
        //->firstOrFail();
    }
}

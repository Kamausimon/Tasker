<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project
extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'user_id',
        'tasks',
        'priority',
        'tags',
        'completed',
        'collaborators'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'completed' => 'boolean',
        'tasks' => 'array',
        'collaborators' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}

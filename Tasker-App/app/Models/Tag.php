<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'task_tags';

    protected $fillable = [
        'name',
        'color'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_tag_task');
    }
}

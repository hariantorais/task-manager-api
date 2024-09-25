<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['taskList', 'members', 'tasks'];

    public function taskList(): HasMany
    {
        return $this->hasMany(TaskList::class, 'id', 'task_list_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'card_users', 'card_id', 'user_id');
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'card_tasks', 'card_id', 'task_id');
    }

}

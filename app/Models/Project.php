<?php

namespace Divit\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * @var array
     */
    public $fillable = [
        'title',
        'description',
        'notes'
    ];

    /**
     * @return string
     */
    public function path()
    {
        return "/projects/{$this->id}";
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    /**
     * @param $body
     * @return mixed
     */
    public function addTask($body)
    {
        return $this->tasks()->create(['body' => $body]);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }


    /**
     * @param string $description
     */
    public function recordActivity($description)
    {
        $this->activity()->create(['description' => $description]);
    }
}

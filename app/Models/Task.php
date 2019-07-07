<?php

namespace Divit\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * @var array
     */
    public $fillable = [
        'body',
        'completed'
    ];


    /**
     * @var array
     */
    protected $touches = ['project'];


    /**
     * @return string
     */
    public function path()
    {
        return '/projects/' . $this->project->id . '/tasks/' . $this->id;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}

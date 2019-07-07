<?php

namespace Divit\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

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
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean'
    ];


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


    /**
     * @return void
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->project->recordActivity('completed_task');
    }


    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->project->recordActivity('uncompleted_task');
    }
}

<?php

namespace Divit\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'project_id',
        'description'
    ];
}

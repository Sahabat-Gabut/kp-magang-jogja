<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressProject extends Model
{
    protected $table        = "progress_project";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'project_id',
        'name',
        'explanation',
        'status',
        'date_of_created'
    ];

    public function project()
    {
        return $this->hasMany(Project::class, 'id');
    }
}

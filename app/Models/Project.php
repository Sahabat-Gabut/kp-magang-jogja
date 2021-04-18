<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table        = "project";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'team_apprentice_id',
        'name_project',
        'final_project',
        'explanation',
        'status_project'
    ];
}

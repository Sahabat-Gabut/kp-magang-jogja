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
        'apprentice_id',
        'name',
        'explanation',
        'status',
        'date_of_created'
    ];

    public function project() {
        return $this->hasMany(Project::class, 'id');
    }

    public function jss() {
        return $this->hasManyThrough(Jss::class, Apprentice::class, 'id','id','apprentice_id','jss_id');
    }
    
    public function valuation() {
        return $this->hasOne(Valuation::class, 'progress_project_id');
    }
}

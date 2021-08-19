<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressProject extends Model
{
    public $timestamps = false;
    protected $table = "progress_project";
    protected $fillable = [
        'id',
        'project_id',
        'apprentice_id',
        'name',
        'description',
        'link',
        'status',
        'date_of_created',
    ];

    public function project()
    {
        return $this->hasMany(Project::class, 'id');
    }

    public function jss()
    {
        return $this->hasOneThrough(Jss::class, Apprentice::class, 'id', 'id', 'apprentice_id', 'jss_id');
    }

    public function valuation()
    {
        return $this->hasOne(Valuation::class);
    }
}

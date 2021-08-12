<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jss;
use App\Models\Attendance;

class Apprentice extends Model
{
    protected $table        = "apprentice";
    public $timestamps      = false;
    
    protected $fillable     = [
        'id',
        'npm',
        'jss_id',
        'team_id',
        'cv',
        'photo',
        'status'
    ];

    public function jss()
    {
        return $this->hasOne(Jss::class, 'id','jss_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'apprentice_id', 'id');
    }
    
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'id', 'team_id');
    }
}

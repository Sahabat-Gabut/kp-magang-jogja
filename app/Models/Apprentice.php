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
        'team_apprentice_id',
        'cv',
        'imgSrc'
    ];

    public function jss()
    {
        return $this->hasMany(Jss::class, 'id','jss_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'apprentice_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table        = "attendance";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id',
        'start_attendace', 
        'end_attendace', 
        'apprentice_id',
        'status',
    ];

    public function apprentice()
    {
        return $this->hasOne(apprentice::class, 'id');
    }

    public function apprenticeTeam()
    {
        return $this->hasManyThrough(TeamApprentice::class, Apprentice::class, 'id','team_apprentice_id','id');
    }
}

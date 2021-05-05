<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Agency,Apprentice,Project,Jss,TeamApprentice};
class TeamApprentice extends Model
{
    protected $table        = "team_apprentice";
    public $timestamps      = false;
    protected $fillable     = [
        'id',
        'agency_id',
        'status_hired',
        'university',
        'departement',
        'proposal',
        'presentation',
        'cover_letter',
        'duration',
        'date_of_created'
    ];

    
    public function agency()
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'team_apprentice_id');
    }

    public function apprenticeUser()
    {
        return $this->hasManyThrough(Jss::class, Apprentice::class, 'team_apprentice_id','id','id','jss_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'team_apprentice_id');
    }

    public function attendance()
    {
        return $this->hasManyThrough(Attendance::class, Apprentice::class, 'team_apprentice_id', 'apprentice_id','id','id');
    }
}

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
        'status_hired',
        'agency_id',
        'university',
        'departement',
        'proposal',
        'presentation',
        'cover_letter',
        'date_of_created'
    ];

    
    public function agencyDetail()
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

    public function apprenticeProject()
    {
        return $this->hasOne(Project::class, 'team_apprentice_id');
    }
}

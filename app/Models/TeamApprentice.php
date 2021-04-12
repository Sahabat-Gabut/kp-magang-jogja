<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamApprentice extends Model
{
    protected $table        = "team_apprentice";
    protected $primaryKey   = "id_team";
    protected $fillable     = [
        'id_team',
        'status_hired',
        'university',
        'depatement',
        'proposal',
        'presentation',
        'cover_letter',
        'date_of_created'
    ];
}

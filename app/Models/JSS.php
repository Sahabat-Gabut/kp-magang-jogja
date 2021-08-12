<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\{Admin,Apprentice,Attendance,Team,Project};

class JSS extends Authenticatable {

    protected $table        = "jss";
    protected $primaryKey   = "id";
    protected $keyType      = "string";
    protected $fillable = [
        'id',
        'username',
        'fullname',
        'email',
        'no_wa',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['NIK','password'];

    public function admin()
    {
        return $this->hasOne(Admin::class,'jss_id','id');
    }

    public function apprentice()
    {
        return $this->hasOne(Apprentice::class, 'jss_id');
    }
  
    // public function adminRole()
    // {
    //     return $this->hasOneThrough(RoleAdmin::class, Admin::class,'jss_id','id','id','role_admin_id');
    // }


    // public function apprenticeTeam()
    // {
    //     return $this->hasOneThrough(Team::class,Apprentice::class, 'jss_id', 'id','id','team_id');
    // }

    // public function apprenticeTeams()
    // {
    //     return $this->hasManyThrough(Team::class,Apprentice::class, 'jss_id', 'id','id','team_id');
    // }

    // public function apprenticeProject()
    // {
    //     return $this->hasOneThrough(Project::class, Apprentice::class, 'jss_id','team_id','id','team_id');
    // }

    // public function apprenticeAttendance()
    // {
    //     return $this->hasOneThrough(Attendance::class, Apprentice::class, 'jss_id', 'id', 'id', 'apprentice_id');
    // }
}

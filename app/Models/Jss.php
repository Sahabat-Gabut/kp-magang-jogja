<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\{Admin,Apprentice,TeamApprentice,Project};

class Jss extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "jss";
    protected $primaryKey = "id";
    public $timestamps      = false;
    protected $fillable = [
        'id',
        'NIK',
        'username',
        'fullname',
        'password',
        'email',
        'no_wa',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function adminDetail()
    {
        return $this->hasOne(Admin::class,'jss_id','id');
    }

    public function adminRole()
    {
        return $this->hasOneThrough(RoleAdmin::class, Admin::class,'jss_id','id');
    }

    public function apprenticeDetail()
    {
        return $this->hasOne(Apprentice::class, 'jss_id');
    }

    public function apprenticeTeam()
    {
        return $this->hasOneThrough(TeamApprentice::class,Apprentice::class, 'jss_id', 'id','id','team_apprentice_id');
    }
    
    public function apprenticeProject()
    {
        return $this->hasOneThrough(Project::class, Apprentice::class, 'jss_id','team_apprentice_id','id','team_apprentice_id');
    }
}
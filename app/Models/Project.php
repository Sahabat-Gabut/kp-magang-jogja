<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\{Team,ProgressProject};

class Project extends Model
{
    protected $table        = "project";
    public $timestamps      = false;

    protected $fillable     = [
        'id',
        'team_id',
        'name',
        'description',
        'status'
    ];

    public function progress()
    {
        return $this->hasMany(ProgressProject::class)->orderBy('id','ASC');
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search) {
            $query->where('name','ilike','%'.$search.'%');
        });
    }

    public function get(bool $isAdmin)
    {
        $auth = Auth::user()->load('apprentice.team');

        return $isAdmin ? Project::with(['team.agency','team.apprentices.jss'])
                        : Project::with(['progress.jss', 'team.apprentices.jss','team.admin.jss'])
                                ->where('team_id',$auth->apprentice->team->id)
                                ->first();
    }

    public function percentageTeam($project)
    {
        $auth = Auth::user()->load('admin');
        if($auth->admin) return 0;

        return number_format($project->progress->where('status','SELESAI')->count()/$project->progress->count()*100);
    }
}

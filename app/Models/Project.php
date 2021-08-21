<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    public $timestamps = false;
    protected $table = "project";
    protected $fillable = [
        'id',
        'team_id',
        'name',
        'description',
        'status',
    ];

    public function progress(): HasMany
    {
        return $this->hasMany(ProgressProject::class)->orderBy('id', 'ASC');
    }

    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'ilike', '%' . $search . '%');
        });
    }

    public function get(bool $isAdmin, int $agency_id)
    {
        $auth = Auth::user()->load('apprentice.team');

        return $isAdmin ?
            $agency_id > 0 ?
                Project::with(['team.agency', 'team.apprentices.jss', 'progress'])->orWhereHas('team',
                    function ($q) use ($agency_id) {
                        $q->where('agency_id', 'ILIKE', $agency_id);
                    })
                : Project::with(['team.agency', 'team.apprentices.jss', 'progress'])
            : Project::with(['progress.jss', 'team.apprentices.jss', 'team.admin.jss'])
                ->where('team_id', $auth->apprentice->team->id)
                ->first();
    }

    public function percentageTeam($project)
    {
        $auth = Auth::user()->load('admin');
        if ($auth->admin) return 0;

        if ($project->progress->count() > 0) {
            return number_format($project->progress->where('status', 'SELESAI')->count() / $project->progress->count() * 100);
        } else {
            return 0;
        }
    }

    public function percentageTeam2($project): string
    {
        return number_format($project->progress->where('status', 'SELESAI')->count() / $project->progress->count() * 100);
    }
}

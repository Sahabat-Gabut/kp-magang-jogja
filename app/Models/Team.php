<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    public $timestamps = false;
    protected $table = "team";
    protected $fillable = [
        'id',
        'agency_id',
        'admin_id',
        'status',
        'university',
        'department',
        'proposal',
        'presentation',
        'cover_letter',
        'date_start',
        'date_finish',
        'date_of_created',
    ];

    public function agency(): HasOne
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }

    public function validation(): HasOne
    {
        return $this->hasOne(Validation::class);
    }

    public function agencies(): HasMany
    {
        return $this->hasMany(Agency::class, 'id', 'agency_id');
    }

    public function apprentices(): HasMany
    {
        return $this->hasMany(Apprentice::class, 'team_id', 'id');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'team_id');
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

    public function attendance(): HasManyThrough
    {
        return $this->hasManyThrough(Attendance::class, Apprentice::class, 'team_id', 'apprentice_id', 'id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('university', 'ilike', '%' . $search . '%')
                ->orWhereHas('agency', function ($q) use ($search) {
                    $q->where('name', 'ilike', '%' . $search . '%');
                })->orWhereHas('project', function ($q) use ($search) {
                    $q->where('name', 'ilike', '%' . $search . '%');
                });
        })->when($filters['status'] ?? null, function ($query, $search) {
            $query->where('status', 'ilike', '%' . $search . '%');
        });
    }

    public function getByRole(bool $isSuperAdmin, int $agency_id): Builder
    {
        return $isSuperAdmin
            ? Team::with('apprentices.jss', 'project')
                ->where('status', '=', 'DITERIMA')
            : Team::with('apprentices.jss', 'project', 'agencies')
                ->where('status', '=', 'DITERIMA')
                ->where('agency_id', '=', $agency_id);
    }
}

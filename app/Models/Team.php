<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Agency,Apprentice,Project};

class Team extends Model
{
    protected $table        = "team";
    public $timestamps      = false;
    
    protected $fillable     = [
        'id',
        'agency_id',
        'admin_id',
        'status',
        'university',
        'departement',
        'proposal',
        'presentation',
        'cover_letter',
        'date_start',
        'date_finish',
        'date_of_created'
    ];


    public function agency()
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }
    
    public function agencies()
    {
        return $this->hasMany(Agency::class, 'id', 'agency_id');
    }

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'team_id', 'id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'team_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

    public function attendance()
    {
        return $this->hasManyThrough(Attendance::class, Apprentice::class, 'team_id', 'apprentice_id','id','id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search) {
            $query->where('university','ilike','%'.$search.'%')
                  ->orWhereHas('agency', function($q) use ($search) {
                    $q->where('name','ilike','%'.$search.'%');
                })->orWhereHas('project', function($q) use($search) {
                    $q->where('name','ilike','%'.$search.'%');
                });
        })->when($filters['status'] ?? null, function($query, $search) {
            $query->where('status', 'ilike', '%'.$search.'%');
        });
    }
}

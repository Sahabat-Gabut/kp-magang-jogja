<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Agency extends Model
{

    protected $table        = "agency";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'name', 
        'location',
        'total_team',
        'quota'
    ];

    public function team()
    {
        return $this->belongTo(Team::class, 'id', 'agency_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'ilike', '%'.$search.'%');
        });
    }
}

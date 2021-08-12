<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table        = "attendance";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id',
        'start_attendance', 
        'end_attendance', 
        'apprentice_id',
        'status',
    ];

    
    public function getApprentice()
    {
        return $this->hasOne(Apprentice::class);
    }

    public function apprentice() {
        return $this->belongsTo(Apprentice::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['select'] ?? null, function($query, $select) {
            $query->where('apprentice_id','=',$select);
        });
    }
}
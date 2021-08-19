<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public const ONTIME = 'TEPAT WAKTU';
    public const LATE = 'TERLAMBAT';
    public $timestamps = false;
    protected $table = "attendance";
    protected $fillable = [
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

    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class);
    }

    public function percentage()
    {
        return $this->select('status, (COUNT(status) * 100 / (SELECT COUNT(*) FROM attendance)) as percentage')
            ->whereColumn('status', '<>', 'NULL')
            ->groupBy('status');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['select'] ?? null, function ($query, $select) {
            $query->where('apprentice_id', '=', $select);
        });
    }
}

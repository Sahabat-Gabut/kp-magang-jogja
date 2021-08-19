<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Apprentice extends Model
{
    public $timestamps = false;
    protected $table = "apprentice";
    protected $fillable = [
        'id',
        'npm',
        'jss_id',
        'team_id',
        'cv',
        'photo',
        'status',
    ];

    /**
     * @return HasOne
     */
    public function jss(): HasOne
    {
        return $this->hasOne(Jss::class, 'id', 'jss_id');
    }

    /**
     * @return HasMany
     */
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * @return HasOne
     */
    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    /**
     * @return HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'id', 'team_id');
    }
}

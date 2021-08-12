<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

    protected $table        = "admin";
    public $timestamps      = false;
    protected $fillable     = [
        'id',
        'photo',
        'jss_id',
        'agency_id',
        'role_id',
        'jss_id'
    ];

    public function jss() {
        return $this->hasOne(Jss::class, 'id', 'jss_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
    
    public function agency() {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->orWhereHas('jss', function($q) use ($search) {
                $q->where('fullname','ilike', '%'.$search.'%');
            });
        });
    }
}

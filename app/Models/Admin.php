<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{RoleAdmin,Jss};

class Admin extends Model
{
    protected $table        = "admin";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'role_admin_id', 
        'jss_id', 
        'imgSrc'
    ];

    public function jss()
    {
        return $this->hasMany(Jss::class, 'id', 'jss_id');
    }

    public function roleDetail()
    {
        return $this->hasOne(RoleAdmin::class, 'id', 'role_admin_id');
    }
}

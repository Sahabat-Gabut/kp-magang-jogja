<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User,RoleAdmin};

class Admin extends Model
{
    protected $table        = "admin";
    protected $primaryKey   = "id_admin";
    protected $fillable     = [ 
        'id_admin', 
        'id_role_admin', 
        'id_jss', 
        'imgSrc'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','id_jss');
    }

    public function role()
    {
        return $this->hasOne(RoleAdmin::class,'id_role_admin');
    }

    public function detail()
    {
        return $this->hasOne(RoleAdmin::class,'id_role_admin','id_role_admin');
    }
}

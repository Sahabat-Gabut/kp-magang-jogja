<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    protected $table        = "role_admin";
    protected $primaryKey   = "id_role_admin";
    protected $fillable     = [ 
        'id_role_admin', 
        'name_role_admin'
    ];
}

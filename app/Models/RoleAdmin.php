<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    protected $table        = "role_admin";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'name_role_admin'
    ];
}

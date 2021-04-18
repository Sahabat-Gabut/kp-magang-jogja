<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User,RoleAdmin};

class Admin extends Model
{
    protected $table        = "admin";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'id_role_admin', 
        'id_jss', 
        'imgSrc'
    ];
}

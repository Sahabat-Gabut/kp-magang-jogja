<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Apprentice extends Model
{
    protected $table        = "apprentice";
    protected $primaryKey   = "id_appren";
    protected $fillable     = [
        'id_appren',
        'id_jss',
        'id_team',
        'cv',
        'imgSrc'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Apprentice extends Model
{
    protected $table        = "apprentice";
    public $timestamps      = false;
    protected $fillable     = [
        'id',
        'npm',
        'jss_id',
        'team_apprentice_id',
        'cv',
        'imgSrc'
    ];
}

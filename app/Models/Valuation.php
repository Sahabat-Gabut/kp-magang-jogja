<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    protected $table        = "valuation";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'progress_project_id',
        'score',        
        'description'
    ];
}

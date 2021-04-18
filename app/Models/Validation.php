<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $table        = "validation";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'admin_id',
        'team_apprentice_id',
        'agency_id',
        'result_date',
        'start_date',
        'field_supervisor',
        'response_letter',
        'finish'
    ];
}

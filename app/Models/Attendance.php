<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table        = "attendance";
    public $timestamps      = false;
    protected $fillable     = [ 
        'date_att', 
        'apprentice_id',
        'first_timesheet',
        'last_timesheet',
        'status_early',
        'status_finish'
    ];
}

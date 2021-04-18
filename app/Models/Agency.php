<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TeamApprentice;

class Agency extends Model
{
    protected $table        = "agency";
    public $timestamps      = false;
    protected $fillable     = [ 
        'id', 
        'name', 
        'location',
        'total_apprentice'
    ];

    public function teamApprentice()
    {
        return $this->belongTo(TeamApprentice::class, 'id', 'agency_id');
    }
}

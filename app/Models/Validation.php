<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Validation extends Model
{
    public $timestamps = false;
    protected $table = "validation";
    protected $fillable = [
        'id',
        'admin_id',
        'team_id',
        'result_date',
        'response_letter',
    ];

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}

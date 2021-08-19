<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JSS extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "jss";
    protected $primaryKey = "id";
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'username',
        'fullname',
        'email',
        'no_wa',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['NIK', 'password'];

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'jss_id', 'id');
    }

    public function apprentice(): HasOne
    {
        return $this->hasOne(Apprentice::class, 'jss_id');
    }
}

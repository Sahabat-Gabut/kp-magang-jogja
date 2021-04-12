<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\{Admin,Apprentice};

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "jss_users";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'NIK',
        'username',
        'fullname',
        'password',
        'email',
        'no_wa',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function adminDetail()
    {
        return $this->hasOne(Admin::class, 'id_jss');
    }

    public function apprenticeDetail()
    {
        return $this->hasOne(Apprentice::class, 'id_jss');
    }
}
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = ['username', 'password', 'nama_tim', 'nama_role'];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'nama_role', 'nama_role'); // Menghubungkan nama_role
    }
    
}

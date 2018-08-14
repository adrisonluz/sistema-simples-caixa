<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_PERMISSION = 'admin';
    const DEFAULT_PERMISSION = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()    {        
        return $this->permission === self::ADMIN_PERMISSION;    
    }

    public function scopeAtivos($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInativos($query)
    {
        return $query->where('status', 0);
    }

    public function tipo(){
        return $this->belongsTo('\App\Tipo', 'type_id');
    }
}

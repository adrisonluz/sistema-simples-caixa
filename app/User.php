<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const ADMIN_PERMISSION = 'admin';
    const DEFAULT_PERMISSION = 'default';

    protected $dates = ['deleted_at'];

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

    public function scopeTodos($query){
        return $query->withTrashed();
    }

    public function scopeInativos($query){
        return $query->onlyTrashed();
    }

    public function tipo(){
        return $this->belongsTo('\App\Tipo', 'type_id');
    }
}

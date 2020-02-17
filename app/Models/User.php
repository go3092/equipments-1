<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'idusers';
    public $incrementing = false;

    protected $casts = [
       'active' => 'boolean'
    ];


    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function isAdmin()
    {
      if ($this->role == 'a') {
        return true;
      }else{
        return false;
      }
    }

    public function isSupervisor()
    {
      if ($this->role == 'a' || $this->role == 'l' ) {
        return true;
      }else{
        return false;
      }
    }

    public function isManager()
    {
      if ($this->role == 'a' || $this->role == 'm' ) {
        return true;
      }else{
        return false;
      }
    }

    public function approvals()
    {
      return $this->hasMany('App\Models\Approvals','idusers')->where('seen',0);
    }
}

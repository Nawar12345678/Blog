<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Http\Controllers\pagesControlle;

use App\Http\Controllers\RegisterControlle;


class User extends Authenticatable
{

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    
    public function comments(){
        return $this->hasMany(Comment::class );
    }



    public function roles(){
        return $this->belongsToMany('App\Models\Role','user_role', 'user_id', 'role_id' );
    }

    public function hasAnyRole($roles){
        if(is_array($roles))
        {
            foreach ($roles as $role){
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        }
        else
        {
            if($this->hasRole($roles))
            {
                return true;
            }

        }

    }

    public function hasRole($role){
        if($this->roles()->where('name', $role )->first())
        {
            return true;
        }
        return false;

    }






    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

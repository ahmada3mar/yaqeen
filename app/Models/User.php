<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \App\Models\Policy;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'branch_id',
        'role',
        'password',
    ];

    public static $admins = [
        'exporter',
        'accounting',
        'employee',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function policy()
    {
        return $this->hasMany(Policy::class);
    }
    
    public function userBranch()
    {

        return $this->belongsToMany(Branch::class);
    }

    public function getMyPolicy()
    {
        return Policy::where(function($q){
            $q->where( 'user_id' , $this->id)->orWhereIn('branch_id' , $this->userBranch->pluck('id')->toArray());
        });
    }
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


}

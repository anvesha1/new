<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;



    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    // app/Models/User.php

    public function assignedTasks()
    {
        return $this->hasMany(AssignedTask::class);
    }


    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

//    public function hasRole($role)
//    {
//        if (is_string($role)) {
//            return $this->roles->contains('name', $role);
//        }
//
//        if (is_int($role)) {
//            return $this->roles->contains('id', $role);
//        }
//
//        return false;
//    }

}

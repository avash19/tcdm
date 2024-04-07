<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneNumber',
        'role',
        'offDay',
        'startTime',
        'endTime',
        'payDay',
        'role'
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

    //RELATION BETWEEN USER AND TASK-COMMENTID
    public function comments()
    {
        return $this->hasMany(Event::class, 'commentId');
    }

    //RELATION BETWEEN USER AND TASK-MESSAGING
    public function messages()
    {
        return $this->hasMany(Event::class, 'messageId');
    }

    //RELATION BETWEEN USER AND TASK-CALENDERSPREADSHEET
    public function calenderSpreads()
    {
        return $this->hasMany(Event::class, 'calendarSpreadId');
    }

    //RELATION BETWEEN USER AND TASK-FOLLOWUPS
    public function followUps()
    {
        return $this->hasMany(Event::class, 'followUpId');
    }

    //RELATION BETWEEN USER AND ATTENDANCE
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'userId');
    }

    // app/User.php

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }




}

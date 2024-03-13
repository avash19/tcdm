<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable=[
        'checkIn',
        'checkOut',
        'userId',
        'officeHourId'
    ];

    //RELATION BETWEEN USER AND ATTENDANCE
    public function user(){
        return $this->belongsTo(User::class,'userId');
    }
}

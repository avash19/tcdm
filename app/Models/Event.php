<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'startDate',
        'endDate',
        'clientId',
        'messageId',
        'messageStatus',
        'commentId',
        'commentStatus',
        'calendarSpreadId',
        'calendarSpreadStatus',
        'followUpId',
        'followUpStatus',
        'messageRemark',
        'commentRemark',
        'calendarSpreadRemark',
        'followUpRemark'
    ];

    //RELATION BETWEEN USER AND TASK-COMMENTID
    public function userComment(){
        return $this->belongsTo(User::class,'commentId');
    }

     //RELATION BETWEEN USER AND TASK-MESSAGING
     public function userMessage(){
        return $this->belongsTo(User::class,'messageId');
    }

     //RELATION BETWEEN USER AND TASK-CALENDERSPREADSHEET
     public function userCalendarSpread(){
        return $this->belongsTo(User::class,'calendarSpreadId');
    }

      //RELATION BETWEEN USER AND TASK-FOLLOWUPS
      public function userFollowUp(){
        return $this->belongsTo(User::class,'followUpId');
    }

    //RELATION BETWEEN EVENT AND CLIENT
    public function client(){
        return $this->belongsTo(Client::class,'clientId');
    }
}

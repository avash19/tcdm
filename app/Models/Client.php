<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'address',
        'role',
        'facebookPageLink'
    ];

    // RELATION BETWEEN EVENT AND CLIENT
    public function events(){
        return $this->hasMany(Event::class,'clientId');
    }

    // RELATION BETWEEN CLIENT-CUSTOMER AND CLIENT
    public function customers(){
        return $this->hasMany(ClientCustomer::class,'clientId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'address',
        'clientId'
    ];


    // RELATION BETWEEN CLIENT-CUSTOMER AND CLIENT
    public function client(){
        return $this->belongsTo(Client::class,'clientId');
    }
}

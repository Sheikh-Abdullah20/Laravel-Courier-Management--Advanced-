<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function agent(){
        return $this->belongsTo(User::class,'user_id');
    }
}

<?php

namespace App\Models;

use App\Models\RiderAssignedShipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedshipmentRider(){
        return $this->hasOne(RiderAssignedShipment::class, 'shipment_id');
    }

 

    
   
}

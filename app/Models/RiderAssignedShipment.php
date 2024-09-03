<?php

namespace App\Models;

use App\Models\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderAssignedShipment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shipments(){
        return $this->hasMany(Shipment::class,'shipment_id');
    }

    public function has_Riders(){
        return $this->hasMany(Rider::class,'rider_id');
    }
}

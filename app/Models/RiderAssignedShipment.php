<?php

namespace App\Models;

use App\Models\Rider;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderAssignedShipment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rider(){
        return $this->belongsTo(Rider::class,'rider_id');
    }

    public function shipment(){
        return $this->belongsTo(Shipment::class,'shipment_id');
    }
}

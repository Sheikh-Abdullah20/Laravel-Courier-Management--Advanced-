<?php

namespace App\Models;

use App\Models\RiderAssignedShipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rider(){
        return $this->belongsTo(RiderAssignedShipment::class,'rider_id');
    }
}

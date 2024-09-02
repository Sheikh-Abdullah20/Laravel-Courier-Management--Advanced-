<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $trackSearch = $request->track;
        $shipment = Shipment::where('tracking_number', $trackSearch)->first();

        return view('trackings.index', compact('shipment', 'trackSearch'));
    }

    public function create()
    {
        return view('trackings.create');
    }
}

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
        return view('trackings.index',compact('shipment','trackSearch'));
    }

  
    public function create()
    {
        return view('trackings.create');
    }

 
    public function store(Request $request)
    {
        //
    }

 
    public function show(string $id)
    {
        //
    }

 
    public function edit(string $id)
    {
        return view('trackings.edit');
    }

 
    public function update(Request $request, string $id)
    {
        //
    }

 
    public function destroy(string $id)
    {
        //
    }
}

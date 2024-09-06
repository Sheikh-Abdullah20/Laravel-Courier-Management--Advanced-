<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Shipment;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $shipments = Shipment::all();
            $users = User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->get();

            $agents = User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'agent');
            })->get();

            $statuss = Status::all(); 
        
            $shipments = Shipment::all();
            $statusCount = $shipments->countBy('status_shipment');
            $riders = Rider::all();

            // chart Statuses
            $chartStatusCount = $shipments->countBy('status_shipment');
            $chartStatusCountDelivered = $chartStatusCount['Delivered'] ?? 0;
            $chartStatusCountOntheway = $chartStatusCount['On the way'] ?? 0;
            $chartStatusCountOrderInitiated = $chartStatusCount['Order Initiated'] ?? 0;

            return view('index', compact('agents', 'shipments', 'users', 'riders', 'statuss', 'statusCount','chartStatusCountOrderInitiated','chartStatusCountDelivered','chartStatusCountOntheway'));

        } elseif (Auth::user()->hasRole('agent')) {
            $statuss = Status::all();
            $shipments = Shipment::where('user_id', Auth::user()->id)->get();
            $statusCount = $shipments->countBy('status_shipment');

              // chart Statuses
              $chartStatusCount = $shipments->countBy('status_shipment');
              $chartStatusCountDelivered = $chartStatusCount['Delivered'] ?? 0;
              $chartStatusCountOntheway = $chartStatusCount['On the way'] ?? 0;
              $chartStatusCountOrderInitiated = $chartStatusCount['Order Initiated'] ?? 0;
            return view('index', compact('shipments', 'statuss', 'statusCount','chartStatusCountOrderInitiated','chartStatusCountDelivered','chartStatusCountOntheway'));
        } else {
            $statuss = Status::all();
            $shipments = Shipment::where('receiver_email', Auth::user()->email)->get();
            $statusCount = $shipments->countBy('status_shipment');
            // chart Statuses
            $chartStatusCount = $shipments->countBy('status_shipment');
            $chartStatusCountDelivered = $chartStatusCount['Delivered'] ?? 0;
            $chartStatusCountOntheway = $chartStatusCount['On the way'] ?? 0;
            $chartStatusCountOrderInitiated = $chartStatusCount['Order Initiated'] ?? 0;

            return view('index', compact('shipments', 'statuss', 'statusCount','chartStatusCountOrderInitiated','chartStatusCountDelivered','chartStatusCountOntheway'));
        }

    }
}

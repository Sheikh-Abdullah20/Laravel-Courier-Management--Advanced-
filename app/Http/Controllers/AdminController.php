<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Rider;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin')){
            $shipments = Shipment::all();
            $agents = Agent::all();
            $users = User::all();
            $riders = Rider::all();
            return view('index',compact('agents','shipments','users','riders'));

        }elseif(Auth::user()->hasRole('agent')){
            $shipments = Shipment::where('agent_name', Auth::user()->name)->get();
            return view('index',compact('shipments'));
        }else{
            if(Auth::user()->hasPermissionTo('view dashboard')){
                return view('index');
            }else{
                return view('trackings.index');
            }
        }
        
    }
}

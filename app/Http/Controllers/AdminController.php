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
    public function index(){
        if(Auth::user()->hasRole('admin')){
            $shipments = Shipment::all();
            $users = User::with('roles')->whereHas('roles', function($query){
                $query->where('name','user');
            })->get();
         
            $agents = User::with('roles')->whereHas('roles', function($query){
                $query->where('name','agent');
            })->get();
            
            $statuss = Status::all();
            $shipments = Shipment::all();
            $agents = User::with('roles')->whereHas('roles',function($query){
                $query->where('name', 'agent');
            })->get();
            $statusCount =  $shipments->countBy('status');

            $riders = Rider::all();
            return view('index',compact('agents','shipments','users','riders','statuss','statusCount'));

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

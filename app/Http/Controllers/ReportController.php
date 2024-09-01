<?php

namespace App\Http\Controllers;



use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller implements HasMiddleware
{
    public static function middleware() :array{
        return[
            new Middleware('permission:view reports',['only' => 'index']),
        ];
    }
    public function index(Request $request){
      $agents = User::with('roles')->whereHas('roles',function($query){
        $query->where('name','agent');
      })->distinct('city')->get(['city']);


        
        $date = $request->date;
        $city = $request->city;

        // $shipments = Shipment::where('shipping_date',$date)->orWhere('city',$city)->paginate(10);

        // $shipments = Shipment::when($date, function($query,$date){
        //    return  $query->where('shipping_date',$date);
        // })->when(function($query) use ($city){
        //    return  $query->where('city',$city);
        // })->paginate(10);

        // $total_shipments = Shipment::when($date, function($query,$date){
        //     return  $query->where('shipping_date',$date);
        //  })->when(function($query) use ($city){
        //     return  $query->where('city',$city);
        //  })->count();
        $shipments =  Shipment::query();
        if($date && $city){
            $shipments->where('shipping_date',$date)->where('city',$city);
        }elseif($date){
            $shipments->where('shipping_date',$date);
        }elseif($city){
            $shipments->where('city',$city);
        }
        $shipments = $shipments->paginate(10);
        $total_shipments = $shipments->count();
        return view('reports.index',compact('agents','shipments','date','city','total_shipments'));
    }
}

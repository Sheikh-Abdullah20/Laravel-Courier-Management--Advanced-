<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Shipment;
use App\Models\Status;
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
    public function index(){
        $statuss = Status::all();
        $shipments = Shipment::all();
        $agents = Agent::all();
        $statusCount =  $shipments->countBy('status');
        return view('reports.index',compact('statuss','statusCount','agents'));
    }
}

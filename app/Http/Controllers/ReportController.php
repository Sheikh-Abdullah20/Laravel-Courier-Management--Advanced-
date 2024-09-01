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

        
        if($request->has('download')){
            $filename = 'Report_' . time() . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Dissposition' => 'attachments, filename="'. $filename . '"'
            ];

            $generate = function() use ($shipments){
                $file = fopen("php://output",'w');

                fputcsv($file,[
                    'Tracking Number','Agent Name', 'Agent Branch', 'Agent City','Shipping Date','Sender Name','Receiver Name','Sender Phone','Receiver Phone','Pickup Address','Deliver Address','Return Address','City','Approval Status', 'Shipment Status','Package Type','Payment Method','Amount'
                ]);

                foreach($shipments as $shipment){
                    fputcsv($file,[
                        $shipment->tracking_number,
                        $shipment->agent_name,
                        $shipment->agent->branch,
                        $shipment->agent->city,
                        $shipment->shipping_date,
                        $shipment->sender_name,
                        $shipment->receiver_name,
                        $shipment->sender_phone,
                        $shipment->receiver_phone,
                        $shipment->pickup_address,
                        $shipment->deliver_address,
                        $shipment->return_address,
                        $shipment->city,
                        $shipment->status,
                        $shipment->status_shipment,
                        $shipment->package_type,
                        $shipment->payment_method,
                        $shipment->amount

                    ]);
                }
                fclose($file);
            };
            return response()->stream($generate,200,$headers);
        }
        return view('reports.index',compact('agents','shipments','date','city','total_shipments'));
    }
}

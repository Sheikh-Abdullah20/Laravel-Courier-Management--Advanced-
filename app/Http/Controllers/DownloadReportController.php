<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

class DownloadReportController extends Controller  implements HasMiddleware
{
    public static function middleware() :array{
        return[
            new Middleware('permission:download reports',['only' => 'shipmentReport']),
            new Middleware('permission:download reports',['only' => 'userReport']),
        ];
    }
   public function shipmentReport(){
    if(Auth::user()->hasRole('admin')){
    $shipments = Shipment::all();
    $filename = 'Shipment_Report_' . time() . '.csv';
   

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Dissposition' => 'attachments; filename="'.$filename .'"'
    ];

   

    $generate = function() use ($shipments){
        $file = fopen('php://output','w');

        fputcsv($file, ['Shipment_id','Agent_Name','Tracking_Number','Order_Number','Sender_Name','Receiver_Name','Receiver_Phone','Sender Email','Pickup_Address','Delivery_Address','Agent_Name','Shipment_Date','Return_Address','Return_City','From_Country','To_Country','From_City','To_City','From_Area','To_Area','Status','Descripiton','Quantity','Weight','Payment_Method','Amount','created_at']);


    foreach($shipments as $shipment){
        fputcsv($file,[
            $shipment->id,
            $shipment->agent_name,
            $shipment->tracking_number,
            $shipment->order_number,
            $shipment->sender_name,
            $shipment->receiver_name,
            $shipment->receiver_phone,
            $shipment->sender_email,
            $shipment->pickup_address,
            $shipment->delivery_address,
            $shipment->agent_name,
            $shipment->shipping_date,
            $shipment->return_address,
            $shipment->return_city,
            $shipment->from_country,
            $shipment->to_country,
            $shipment->from_city,
            $shipment->to_city,
            $shipment->from_area,
            $shipment->to_area,
            $shipment->status,
            $shipment->descripiton,
            $shipment->quantity,
            $shipment->weight,
            $shipment->payment_method,
            $shipment->amount,
            $shipment->created_at,
        ]);
    }
    fclose($file);
};  

return response()->stream($generate,200,$headers);
}elseif(Auth::user()->hasRole('agent')){
    $shipments = Shipment::where('user_id',Auth::user()->id)->get();
    $filename = 'Shipment_Report_' . time() . '.csv';
   

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Dissposition' => 'attachments; filename="'.$filename .'"'
    ];

   

    $generate = function() use ($shipments){
        $file = fopen('php://output','w');

        fputcsv($file, ['Shipment_id','Agent_Name','Tracking_Number','Order_Number','Sender_Name','Receiver_Name','Receiver_Phone','Sender Email','Pickup_Address','Delivery_Address','Agent_Name','Shipment_Date','Return_Address','Return_City','City','From_Area','To_Area','Status','shipment_status','Descripiton','Quantity','Weight','Payment_Method','Amount','created_at']);


    foreach($shipments as $shipment){
        fputcsv($file,[
            $shipment->id,
            $shipment->agent_name,
            $shipment->tracking_number,
            $shipment->order_number,
            $shipment->sender_name,
            $shipment->receiver_name,
            $shipment->receiver_phone,
            $shipment->sender_email,
            $shipment->pickup_address,
            $shipment->delivery_address,
            $shipment->agent_name,
            $shipment->shipping_date,
            $shipment->return_address,
            $shipment->return_city,
            $shipment->city,
            $shipment->from_area,
            $shipment->to_area,
            $shipment->status,
            $shipment->status_shipment,
            $shipment->descripiton,
            $shipment->quantity,
            $shipment->weight,
            $shipment->payment_method,
            $shipment->amount,
            $shipment->created_at,
        ]);
    }
    fclose($file);
};  

return response()->stream($generate,200,$headers);
}else{
    $shipments = Shipment::where('receiver_email',Auth::user()->email)->get();
    $filename = 'Shipment_Report_' . time() . '.csv';
   

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Dissposition' => 'attachments; filename="'.$filename .'"'
    ];

   

    $generate = function() use ($shipments){
        $file = fopen('php://output','w');

        fputcsv($file, ['Shipment_id','Agent_Name','Tracking_Number','Order_Number','Sender_Name','Receiver_Name','Receiver_Phone','Sender Email','Pickup_Address','Delivery_Address','Agent_Name','Shipment_Date','Return_Address','Return_City','City','From_Area','To_Area','shipment_status','Descripiton','Quantity','Weight','Payment_Method','Amount','created_at']);


    foreach($shipments as $shipment){
        fputcsv($file,[
            $shipment->id,
            $shipment->agent_name,
            $shipment->tracking_number,
            $shipment->order_number,
            $shipment->sender_name,
            $shipment->receiver_name,
            $shipment->receiver_phone,
            $shipment->sender_email,
            $shipment->pickup_address,
            $shipment->delivery_address,
            $shipment->agent_name,
            $shipment->shipping_date,
            $shipment->return_address,
            $shipment->return_city,
            $shipment->city,
            $shipment->from_area,
            $shipment->to_area,
            $shipment->status_shipment,
            $shipment->descripiton,
            $shipment->quantity,
            $shipment->weight,
            $shipment->payment_method,
            $shipment->amount,
            $shipment->created_at,
        ]);
    }
    fclose($file);
};  

return response()->stream($generate,200,$headers);
}
}


public function userReport(){

    $users = User::with('roles')->whereHas('roles',function($query){
        $query->where('name','user');
    })->get();

    $filename = 'User_Report_' . time() . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Dissposition' => 'attachments, filename="' . $filename . '"'
    ];
    

    $generate = function() use ($users){
        $file = fopen('php://output','w');

        fputcsv($file,[
            'id',
            'Name',
            'Email',
            'City',
            'Phone',
            'Address',
            'Date Of Birth',
            'Created_at',
        ]);


        foreach($users as $user){
            fputcsv($file,[
                $user->id,
                $user->name,
                $user->email,
                $user->city,
                $user->phone,
                $user->address,
                $user->dob,
                $user->created_at
            ]);
        }

        fclose($file);
    };

    return response()->stream($generate,200,$headers);
}


public function agentReport(){
    $agents = User::with('roles')->whereHas('roles',function($query){
        $query->where('name','agent');
    })->get();

    $filename = 'Agent_Report_' . time() . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Dissposition' => 'attachment , filename="' . $filename .'"'
    ];

    $generate = function() use ($agents){
        $file = fopen('php://output','w');

        fputcsv($file,[
            'id',
            'Name',
            'Email',
            'Phone',
            'Branch',
            'Address',
            'Created_at'
        ]);

        foreach($agents as $agent){
            fputcsv($file,[
                $agent->id,
                $agent->name,
                $agent->email,
                $agent->phone,
                $agent->branch,
                $agent->address,
                $agent->created_at
            ]);
        }
        fclose($file);
    };


    return response()->stream($generate,200,$headers);
}


public function riderReport(){
    $riders = Rider::all();

    $filename = 'Rider_Report' . time() . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Dissposition' => 'attachment , filename="' . $filename .'"'
    ];

     $generate = function() use ($riders){
        $file = fopen('php://output','w');

        fputcsv($file,[
            'Rider_ID',
            'Rider_Name',
            'Rider_Phone',
            'Rider_Cnic',
            'Rider_Bike_No',
            'Rider_Address'
        ]);

        foreach($riders as $rider){
            fputcsv($file,[
                $rider->id,
                $rider->name,
                $rider->phone,
                $rider->rider_cnic,
                $rider->bike_no,
                $rider->address
            ]);
        }

        fclose($file);
    };

    return response()->stream($generate,200,$headers);
}
}

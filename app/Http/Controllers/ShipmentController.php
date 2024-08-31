<?php

namespace App\Http\Controllers;

use App\Mail\approvedShipmentMail;
use App\Mail\deliveredShipmentMail;
use App\Mail\onTheWayShipmentMail;
use App\Mail\shipmentCreationMail;
use App\Models\Agent;
use App\Models\Rider;
use App\Models\Shipment;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ShipmentController extends Controller implements HasMiddleware
{
    public static function middleware() :array{
        return[
            new Middleware('permission:view shipments',['only' => 'index']),
            new Middleware('permission:create shipments',['only' => 'create']),
            new Middleware('permission:edit shipments',['only' => 'edit']),
            new Middleware('permission:show shipments',['only' => 'show']),
            new Middleware('permission:delete shipments',['only' => 'destroy']),
        ];
    }
   
   
    public function index(Request $request)
    {
        $user = Auth::user();
        $branch_status = Agent::where('owner_name',$user->name)->first();
 
        $action = $request->action;
        if($action === 'delete'){
            $selectedIds = $request->selected;
            $shipments = Shipment::whereIn('id', $selectedIds)->delete();
            if($shipments){
                return redirect()->route('shipment.index')->with('delete','Selected Shipments deleted successfully');
            }else{
                return redirect()->route('shipment.index')->with('error','Shipments not Deleted Something went wrong');
            }
        }else if($action === 'print'){
            $selectedIds = $request->selected;
            $rider =  $request->rider_id;
            $findRider = Rider::find($rider);
            $shipments = Shipment::whereIn('id', $selectedIds)->get();
            return view('shipments.print',compact('selectedIds','shipments','findRider'));  

        }
        
        if(Auth::user()->hasRole('admin')){
            $agents = Agent::all();
            $statuss = Status::all();
            $agentSearch = $request->agents;
            $statusSearch = $request->status;
            $shipments = Shipment::when(!empty($agentSearch), function($query) use ($agentSearch){
                $query->where('agent_name','like', '%'.$agentSearch.'%');
             
       })->where('status','like', '%'. $statusSearch . '%')->orderBy('created_at','desc')->paginate(10);
      
        }else{
            $agents = Agent::where('owner_name',Auth::user()->name)->get();
            $statuss = Status::all();
            $agentSearch = $request->agents;
            $statusSearch = $request->status;
            $shipments = Shipment::when(!empty($agentSearch), function($query) use ($agentSearch){
                $query->where('agent_name','like', '%'.$agentSearch.'%');
       })->where('status','like', '%'. $statusSearch . '%')->where('agent_name',Auth::user()->name)->paginate(10);
        }
       
        $riders = Rider::all();
        // return $riders;
       return view('shipments.index',compact('shipments','statuss','agents','riders','branch_status'));
    }


    public function create()
    {
        $user = Auth::user();
        $agent = Agent::where('owner_name',$user->name)->first(['branch_status']);
        if($user->hasRole('agent') && $agent->branch_status !== 'Active'){
            return redirect()->route('shipment.index')->with('error','Your Branch is Not Active Yet to create shipments in this branch');
        }

        if(Auth::user()->hasRole('admin')){
            $agents = Agent::all();
        }else{
            $agents = Agent::where('owner_name',Auth::user()->name)->get();
        }
        return view('shipments.create',compact('agents'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'agent_name' => 'required',
            'shipping_date' =>'required',
            'sender_name' =>'required',
            'receiver_name' =>'required',
            'sender_email' =>'required|email',
            'sender_phone' =>'required',
            'receiver_phone' =>'required',
            'pickup_address' =>'required',
            'delivery_address' =>'required',
            'return_address' =>'required',
            'return_city' =>'required',
            'from_country' =>'required',
            'to_country' =>'required',
            'from_city' =>'required',
            'to_city' =>'required',
            'from_area' =>'required',
            'to_area' =>'required',
            'payment_method' =>'required',
            'package_type' =>'required',
            'quantity' =>'required|numeric',
            'weight' =>'required',
            'amount' =>'required',

        ]);
        $tracking_number = mt_rand(1111111111,9999999999);
        $order_number = mt_rand(111111,222222);
        $shipment = Shipment::create([
            'agent_name' => $request->agent_name,
            'shipping_date' => $request->shipping_date,
            'sender_name' => $request->sender_name,
            'receiver_name' => $request->receiver_name,
            'sender_email' => $request->sender_email,
            'sender_phone' => $request->sender_phone,
            'receiver_phone' => $request->receiver_phone,
            'pickup_address' => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'return_address' => $request->return_address,
            'return_city' => $request->return_city,
            'from_country' => $request->from_country,
            'to_country' => $request->to_country,
            'from_city' => $request->from_city,
            'to_city' => $request->to_city,
            'from_area' => $request->from_area,
            'to_area' =>$request->to_area,
            'payment_method' => $request->payment_method,
            'package_type' =>  $request->package_type,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'amount' => $request->amount,
            'description' => $request->description,
            'order_number' => $order_number,
            'tracking_number' => $tracking_number,
            'user_id' => Auth::user()->id
        ]);

        if($shipment){
            $email = $request->sender_email;
            Mail::to($email)->send(new shipmentCreationMail($request->all(),$shipment));
            return redirect()->route('shipment.index')->with('success','Shipment created successfully');
        }else{
            return redirect()->route('shipment.create')->with('error','Failed to create shipment');
        }
    }


    public function show(string $id)
    {
        $shipment = Shipment::find($id);
        $url = Route('shipment.show',$shipment->id);
        return view('shipments.show',compact('shipment','url'));
    }

    public function edit(string $id)
    {
        $shipment = Shipment::find($id);
     
        $agents = Agent::all();
        $hasAgent = $shipment->agent_name;
        $hasStatus = $shipment->status;
        $statuss = Status::all();
        // return $hasAgent;
        return view('shipments.edit',compact('shipment','agents','hasAgent','statuss','hasStatus'));
    }

 
   
    public function update(Request $request, string $id)
    {
        // return $request->all();
        $request->validate([
            'agent_name' => 'required',
            'shipping_date' =>'required',
            'sender_name' =>'required',
            'receiver_name' =>'required',
            'sender_email' =>'required|email',
            'sender_phone' =>'required',
            'receiver_phone' =>'required',
            'pickup_address' =>'required',
            'delivery_address' =>'required',
            'return_address' =>'required',
            'return_city' =>'required',
            'from_country' =>'required',
            'to_country' =>'required',
            'from_city' =>'required',
            'to_city' =>'required',
            'from_area' =>'required',
            'to_area' =>'required',
            'payment_method' =>'required',
            'package_type' =>'required',
            'quantity' =>'required|numeric',
            'weight' =>'required',
            'amount' =>'required',
        ]);


        $shipment = Shipment::find($id);
        if($shipment && Auth::user()->hasRole('admin')){
            $updated = $shipment->update([
                'agent_name' => $request->agent_name,
                'shipping_date' => $request->shipping_date,
                'sender_name' => $request->sender_name,
                'receiver_name' => $request->receiver_name,
                'sender_email' => $request->sender_email,
                'sender_phone' => $request->sender_phone,
                'receiver_phone' => $request->receiver_phone,
                'pickup_address' => $request->pickup_address,
                'delivery_address' => $request->delivery_address,
                'return_address' => $request->return_address,
                'return_city' => $request->return_city,
                'from_country' => $request->from_country,
                'to_country' => $request->to_country,
                'from_city' => $request->from_city,
                'to_city' => $request->to_city,
                'from_area' => $request->from_area,
                'to_area' =>$request->to_area,
                'payment_method' => $request->payment_method,
                'package_type' =>  $request->package_type,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
                'amount' => $request->amount,
                'description' => $request->description,
                'order_number' => $request->order_number,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
           if($updated){
            $email = $shipment->sender_email;
            if($request->status === 'Approved'){
                $mail = Mail::to($email)->send(new approvedShipmentMail($request->all(),$shipment));
            }elseif($shipment->status === 'On the way'){
                $mail = Mail::to($email)->send(new onTheWayShipmentMail($request->all(),$shipment));
            }elseif($shipment->status === 'Delivered'){
                $mail = Mail::to($email)->send(new deliveredShipmentMail($request->all(),$shipment));
            }
            return redirect()->route('shipment.index')->with('success','Shipment updated successfully');
           }else{
            return redirect()->route('shipment.index')->with('error','Failed to update shipment');
           }
        }elseif($shipment){
            $updated = $shipment->update([
                'agent_name' => $request->agent_name,
                'shipping_date' => $request->shipping_date,
                'sender_name' => $request->sender_name,
                'receiver_name' => $request->receiver_name,
                'sender_email' => $request->sender_email,
                'sender_phone' => $request->sender_phone,
                'receiver_phone' => $request->receiver_phone,
                'pickup_address' => $request->pickup_address,
                'delivery_address' => $request->delivery_address,
                'return_address' => $request->return_address,
                'return_city' => $request->return_city,
                'from_country' => $request->from_country,
                'to_country' => $request->to_country,
                'from_city' => $request->from_city,
                'to_city' => $request->to_city,
                'from_area' => $request->from_area,
                'to_area' =>$request->to_area,
                'payment_method' => $request->payment_method,
                'package_type' =>  $request->package_type,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
                'amount' => $request->amount,
                'description' => $request->description,
                'order_number' => $request->order_number,
                'status' => $shipment->status,
                'user_id' => Auth::user()->id,
            ]);
           if($updated){
            return redirect()->route('shipment.index')->with('success','Shipment updated successfully');
           }else{
            return redirect()->route('shipment.index')->with('error','Failed to update shipment');
           }
        }
    }


    public function destroy(string $id)
    {
        $shipment = Shipment::find($id);
        if($shipment){
            $shipment->delete();
            return redirect()->route('shipment.index')->with('delete','Shipment deleted successfully');
        } else{
            return redirect()->route('shipment.index')->with('error','Failed to delete shipment');
        }
    }
}

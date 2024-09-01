<?php

namespace App\Http\Controllers;

use App\Mail\approvedShipmentMail;
use App\Mail\deliveredShipmentMail;
use App\Mail\onTheWayShipmentMail;
use App\Mail\shipmentCreationMail;
use App\Models\Rider;
use App\Models\Shipment;
use App\Models\Status;
use App\Models\User;
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
            $agents = User::with('roles')->whereHas('roles',function($query){
                $query->where('name','agent');
            })->get();
            $riders = Rider::all();
            $statuss = Status::all();
            $agentSearch = $request->agents;
            $statusSearch = $request->status;
            $shipments = Shipment::when(!empty($agentSearch), function($query) use ($agentSearch){
                $query->where('agent_name','like', '%'.$agentSearch.'%');
             
       })->where('status_shipment','like', '%'. $statusSearch . '%')->orderBy('created_at','desc')->paginate(10);
       return view('shipments.index',compact('shipments','statuss','agents','riders'));

        }elseif(Auth::user()->hasRole('agent')){
            $agents = User::where('id',Auth::user()->id)->get();
            $statuss = Status::all();
            $agentSearch = $request->agents;
            $statusSearch = $request->status;
            $shipments = Shipment::when(!empty($agentSearch), function($query) use ($agentSearch){
                $query->where('agent_name','like', '%'.$agentSearch.'%');
             })->where('status_shipment','like', '%'. $statusSearch . '%')->where('agent_name',Auth::user()->name)->paginate(10);
            $riders = Rider::all();
            return view('shipments.index',compact('shipments','statuss','agents','riders'));
        }else{
            $statuss = Status::all();
            $statusSearch = $request->status;
            $shipments = Shipment::when(!empty($statusSearch), function($query) use ($statusSearch){
                $query->where('status_shipment','like', '%'.$statusSearch.'%');
             })->where('receiver_email',Auth::user()->email)->paginate(10);
             return view('shipments.index',compact('shipments','statuss'));
        }
       
       
    }


    public function create()
    {
        if(Auth::user()->hasRole('admin')){
            $agents = User::with('roles')->whereHas('roles',function($query){
             $query->where('name','agent');
        })->get();

            return view('shipments.create',compact('agents'));

        }else{
            $city =  Auth::user()->city;
            return view('shipments.create',compact('city'));

        }
    }


    public function store(Request $request)
    {

   if(Auth::user()->hasRole('admin')){
    $agent_id =  $request->agent_name;
    $user = User::find($agent_id);
        $request->validate([
            'agent_name' => 'required',
            'shipping_date' =>'required',
            'sender_name' =>'required',
            'receiver_name' =>'required',
            'sender_email' =>'required|email',
            'receiver_email' =>'required|email',
            'sender_phone' =>'required',
            'receiver_phone' =>'required',
            'pickup_address' =>'required',
            'delivery_address' =>'required',
            'return_address' =>'required',
            'return_city' =>'required',
            'city' =>'required',
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
            'agent_name' => $user->name,
            'shipping_date' => $request->shipping_date,
            'sender_name' => $request->sender_name,
            'receiver_name' => $request->receiver_name,
            'sender_email' => $request->sender_email,
            'receiver_email' => $request->receiver_email,
            'sender_phone' => $request->sender_phone,
            'receiver_phone' => $request->receiver_phone,
            'pickup_address' => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'return_address' => $request->return_address,
            'return_city' => $request->return_city,
            'city' => $request->city,
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
            'user_id' => $user->id
        ]);

        if($shipment){
            $sender_email = $request->sender_email;
            $receiver_email = $request->receiver_email;
            Mail::to([$sender_email , $receiver_email])->send(new shipmentCreationMail($request->all(),$shipment));
            return redirect()->route('shipment.index')->with('success','Shipment created successfully');
        }else{
            return redirect()->route('shipment.create')->with('error','Failed to create shipment');
        }
    }else{
       

        if(Auth::user()->city !== $request->city ){
            return redirect()->back()->with('error','You cannot create Other Cities shipment');
        }
        $agent_id =  $request->agent_name;
        $user = User::find($agent_id);
       
        $request->validate([
            'shipping_date' =>'required',
            'sender_name' =>'required',
            'receiver_name' =>'required',
            'sender_email' =>'required|email',
            'receiver_email' =>'required|email',
            'sender_phone' =>'required',
            'receiver_phone' =>'required',
            'pickup_address' =>'required',
            'delivery_address' =>'required',
            'return_address' =>'required',
            'return_city' =>'required', 
            'city' =>'required',
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
            'agent_name' => Auth::user()->name,
            'shipping_date' => $request->shipping_date,
            'sender_name' => $request->sender_name,
            'receiver_name' => $request->receiver_name,
            'sender_email' => $request->sender_email,
            'receiver_email' => $request->receiver_email,
            'sender_phone' => $request->sender_phone,
            'receiver_phone' => $request->receiver_phone,
            'pickup_address' => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'return_address' => $request->return_address,
            'return_city' => $request->return_city,
            'city' => $request->city,
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
            'user_id' => $user->id
        ]);

        if($shipment){
            $sender_email = $request->sender_email;
            $receiver_email = $request->receiver_email;
            Mail::to([$sender_email,$receiver_email])->send(new shipmentCreationMail($request->all(),$shipment));
            return redirect()->route('shipment.index')->with('success','Shipment created successfully');
        }else{
            return redirect()->route('shipment.create')->with('error','Failed to create shipment');
        }
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
        if( $shipment->status !== 'Approved' && Auth::user()->hasRole('agent')){
            return redirect()->back()->with('error','You cannot edit this shipment Until Its Approved');
        }
        $hasAgent = $shipment->agent_name;
        $hasStatus = $shipment->status_shipment;
        $statuss = Status::all();
        // return $hasAgent;
        return view('shipments.edit',compact('shipment','hasAgent','statuss','hasStatus'));
    }

 
   
    public function update(Request $request, string $id)
    {
       
        $request->validate([
            'shipping_date' =>'required',
            'sender_name' =>'required',
            'receiver_name' =>'required',
            'sender_email' =>'required|email',
            'receiver_email' =>'required|email',
            'sender_phone' =>'required',
            'receiver_phone' =>'required',
            'pickup_address' =>'required',
            'delivery_address' =>'required',
            'return_address' =>'required',
            'return_city' =>'required',
            'city' =>'required',
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
                'agent_name' => $shipment->agent_name,
                'shipping_date' => $request->shipping_date,
                'sender_name' => $request->sender_name,
                'receiver_name' => $request->receiver_name,
                'sender_email' => $request->sender_email,
                'receiver_email' => $request->receiver_email,
                'sender_phone' => $request->sender_phone,
                'receiver_phone' => $request->receiver_phone,
                'pickup_address' => $request->pickup_address,
                'delivery_address' => $request->delivery_address,
                'return_address' => $request->return_address,
                'return_city' => $request->return_city,
                'city' => $request->city,
                'from_area' => $request->from_area,
                'to_area' =>$request->to_area,
                'payment_method' => $request->payment_method,
                'package_type' =>  $request->package_type,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
                'amount' => $request->amount,
                'description' => $request->description,
                'status_shipment' => $request->status_shipment,
                'status' => $request->approval,
                'user_id' => $shipment->user_id,
            ]);
            if($updated){
                $sender_email = $shipment->sender_email;
                $receiver_email = $shipment->receiver_email;
                if($request->status_shipment === 'Approved'){
                    $mail = Mail::to([$sender_email, $receiver_email])->send(new approvedShipmentMail($request->all(),$shipment));
                }elseif($shipment->status_shipment === 'On the way'){
                    $mail = Mail::to([$sender_email, $receiver_email])->send(new onTheWayShipmentMail($request->all(),$shipment));
                }elseif($shipment->status_shipment === 'Delivered'){
                    $mail = Mail::to([$sender_email, $receiver_email])->send(new deliveredShipmentMail($request->all(),$shipment));
                }
                return redirect()->route('shipment.index')->with('success','Shipment updated successfully');
               }else{
                return redirect()->route('shipment.index')->with('error','Failed to update shipment');
               }
        }elseif($shipment){
            $agent_id =  $request->agent_name;
            $user = User::find($agent_id);
            $updated = $shipment->update([
                'agent_name' => $shipment->agent_name,
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
                'city' => $request->city,
                'from_area' => $request->from_area,
                'to_area' =>$request->to_area,
                'payment_method' => $request->payment_method,
                'package_type' =>  $request->package_type,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
                'amount' => $request->amount,
                'description' => $request->description,
                'status_shipment' => $request->status_shipment,
                'user_id' => $shipment->user_id,
            ]);
            if($updated){
                $sender_email = $shipment->sender_email;
                $receiver_email = $shipment->receiver_email;
                if($request->status_shipment === 'Approved'){
                    $mail = Mail::to([$sender_email, $receiver_email])->send(new approvedShipmentMail($request->all(),$shipment));
                }elseif($shipment->status_shipment === 'On the way'){
                    $mail = Mail::to([$sender_email, $receiver_email])->send(new onTheWayShipmentMail($request->all(),$shipment));
                }elseif($shipment->status_shipment === 'Delivered'){
                    $mail = Mail::to([$sender_email, $receiver_email])->send(new deliveredShipmentMail($request->all(),$shipment));
                }
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

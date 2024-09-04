<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\RiderAssignedShipment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RiderController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view riders', ['only' => 'index']),
            new Middleware('permission:create riders', ['only' => 'create']),
            new Middleware('permission:edit riders', ['only' => 'edit']),
            new Middleware('permission:show riders', ['only' => 'show']),
            new Middleware('permission:delete riders', ['only' => 'destroy']),
            new Middleware('permission:view assignedShipment_riders', ['only' => 'assignedShipment_riders']),
        ];
    }

    public function index(Request $request)
    {
        if ($request->filled('selected')) {
            $selectedId = $request->selected;
            Rider::whereIn('id', $selectedId)->delete();

            return redirect()->route('rider.index')->with('delete', 'Selected riders deleted successfully');
        }

        $riders = Rider::paginate(10);

        return view('riders.index', compact('riders'));
    }

    public function create()
    {
        return view('riders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'cnic' => 'required|numeric',
            'bike_no' => 'required|numeric',
            'address' => 'required',
        ]);
        $rider = Rider::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'rider_city' => $request->city,
            'rider_cnic' => $request->cnic,
            'bike_no' => $request->bike_no,
            'address' => $request->address,
        ]);
        if ($rider) {
            return redirect()->route('rider.index')->with('success', 'Rider created successfully');
        } else {
            return redirect()->route('rider.index')->with('error', 'Failed to create rider');
        }
    }

    public function show(string $id)
    {
        $rider = Rider::find($id);
        if ($rider) {
            return view('riders.show', compact('rider'));
        }
    }

    public function edit(string $id)
    {
        $rider = Rider::find($id);

        return view('riders.edit', compact('rider'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'cnic' => 'required|numeric',
            'bike_no' => 'required|numeric',
            'address' => 'required',
        ]);
        $rider = Rider::find($id);
        if ($rider) {
            $updated = $rider->update([
                'name' => $request->name,
                'rider_city' => $request->city,
                'phone' => $request->phone,
                'rider_cnic' => $request->cnic,
                'bike_no' => $request->bike_no,
                'address' => $request->address,
            ]);
            if ($updated) {
                return redirect()->route('rider.index')->with('success', 'Rider updated successfully');
            } else {
                return redirect()->route('rider.index')->with('error', 'Failed to update rider');
            }
        }
    }

    public function destroy(string $id)
    {
        $rider = Rider::find($id);
        if ($rider) {
            $deleted = $rider->delete();

            if ($deleted) {
                return redirect()->route('rider.index')->with('delete', 'Rider deleted successfully');
            } else {
                return redirect()->route('rider.index')->with('error', 'Failed to delete rider');
            }
        } else {
            return redirect()->route('rider.index')->with('error', 'Rider not found');
        }
    }


    public function assignedShipment_riders(Request $request,$id){
        $assignedRiderShipments = RiderAssignedShipment::where('rider_id',$id)->get();
        $rider = Rider::find($id);
        $shipments = collect();

       foreach($assignedRiderShipments as $assginedShipment){
        $shipment = Shipment::where('id',$assginedShipment->shipment_id)->get();
        
        if($shipment){
           $shipments = $shipments->merge($shipment);
        }
    }
        if($request->filled('selected') && $request->filled('rider_id')){
            $riderId = $request->rider_id;
            $selectedId = $request->selected;
            $delete = RiderAssignedShipment::where('rider_id',$riderId)->WhereIn('shipment_id',$selectedId)->delete();
            if($delete){
                return redirect()->back()->with('success','Assigned Shipments Has Been Deleted');
            }
        }


        if($request->has('download')){
            $filename = "AssignedShipments_Rider" . time() . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ];

            $generate = function() use ($shipments){
                $file = fopen("php://output",'w');

                fputcsv($file,[
                    'Order Tracking', 'Agent Name	','City','PickUp Address','Delivery Address','Return Address','Package Type','Weight' ,'Sender Name','Receiver Name','Sender Email','Receiver Email','Order Number' ,'Shipping Date','Assigning Date','Amount'
                ]);

                foreach($shipments as $shipment){
                    fputcsv($file,[
                        $shipment->order_tracking,
                        $shipment->agent_name,
                        $shipment->city,
                        $shipment->pickup_address,
                        $shipment->delivery_address,
                        $shipment->return_address,
                        $shipment->package_type,
                        $shipment->weight,
                        $shipment->sender_name,
                        $shipment->receiver_name,
                        $shipment->sender_email,
                        $shipment->receiver_email,
                        $shipment->order_number,
                        $shipment->shipping_date,
                        $shipment->assigning_date,
                        $shipment->amount
                    ]);
                }

                fclose($file);
            };

            return response()->stream($generate,200,$headers);
        }
       return view('riders.viewAssignedShipments',compact('shipments','rider'));

    }
}

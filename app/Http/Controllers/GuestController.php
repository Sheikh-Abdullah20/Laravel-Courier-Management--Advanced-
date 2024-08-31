<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    public function index(){
        return view('guests.index');
        
    }

    public function tracking(Request $request){
        $trackSearch = $request->track;
        $shipment = Shipment::where('tracking_number', $trackSearch)->first();
        return view('guests.tracking',compact('shipment','trackSearch'));
    }

    public function contact(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        // return $request->all();
        $users = User::whereHas('roles', function($query){
            $query->where('name','admin');
        })->pluck('email');   
        $mail = Mail::to($users)->send(new ContactUsMail($request->all()));
        if($mail){
            return back()->with('success','Message sent successfully!');
        }else{
            return back()->with('error','Failed to send message!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rider;
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
            'phone' => 'required',
            'cnic' => 'required|numeric',
            'bike_no' => 'required|numeric',
            'address' => 'required',
        ]);
        $rider = Rider::create([
            'name' => $request->name,
            'phone' => $request->phone,
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
            'phone' => 'required',
            'cnic' => 'required|numeric',
            'bike_no' => 'required|numeric',
            'address' => 'required',
        ]);
        $rider = Rider::find($id);
        if ($rider) {
            $updated = $rider->update([
                'name' => $request->name,
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
}

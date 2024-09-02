<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StatusController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view status', ['only' => 'index']),
            new Middleware('permission:create status', ['only' => 'create']),
            new Middleware('permission:edit status', ['only' => 'edit']),
            new Middleware('permission:delete status', ['only' => 'destroy']),
        ];
    }
    public function index(Request $request)
    {
        if ($request->filled('selected')) {
            $selectedId = $request->selected;
            Status::whereIn('id', $selectedId)->delete();
            return redirect()->back()->with('delete', 'Selected Status Has Been Deleted Successfully');
        }
        $statuss = Status::paginate(10);
        return view('status.index', compact('statuss'));
    }

    public function create()
    {
        return view('status.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'status_name' => 'required|min:3',
        ]);
        $status = Status::create([
            'status_name' => $request->status_name,
        ]);
        if ($status) {
            return redirect()->route('status.index')->with('success', 'Status created successfully');
        } else {
            return redirect()->route('status.index')->with('error', 'Failed to create status');
        }
    }

    public function edit(string $id)
    {
        $status = Status::find($id);
        return view('status.edit', compact('status'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_name' => 'required',
        ]);

        $status = Status::find($id);
        if ($status) {
            $updated = $status->update([
                'status_name' => $request->status_name,
            ]);

            if ($updated) {
                return redirect()->route('status.index')->with('success', 'Status updated successfully');
            } else {
                return redirect()->route('status.index')->with('error', 'Failed to update status');
            }
        } else {
            return redirect()->route('status.index')->with('error', 'Status not found');
        }
    }

    public function destroy(string $id)
    {
        $status = Status::find($id);
        if ($status->delete()) {
            return redirect()->route('status.index')->with('delete', 'Status deleted successfully');
        } else {
            return redirect()->route('status.index')->with('error', 'Failed to delete status');
        }
    }
}

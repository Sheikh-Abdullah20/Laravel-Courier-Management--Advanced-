<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view agents', ['only' => 'index']),
            new Middleware('permission:create agents', ['only' => 'create']),
            new Middleware('permission:edit agents', ['only' => 'edit']),
            new Middleware('permission:show agents', ['only' => 'show']),
            new Middleware('permission:delete agents', ['only' => 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        if ($request->filled('selected')) {
            $selectedId = $request->selected;
            $agents = User::whereIn('id', $selectedId)->delete();

            return redirect()->back()->with('delete', 'Selected Agents deleted successfully');
        }
        $search = $request->search;
        $agents = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'agent');

        })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                        // ->orWhere('phone', 'like', '%'.$search.'%');
                        // ->orWhere('branch', 'like', '%'.$search.'%');
                });

            })
            ->paginate(10);

        return view('agents.index', compact('agents', 'search'));
    }

    public function create()
    {
        return view('agents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'address' => 'required',
            'branch_name' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $agent = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'branch' => $request->branch_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'city' => $request->city,
            'password' => $request->password,

        ]);
        if ($agent) {
            $mail = Mail::to($request->email)->send(new AccountCreationMail($request->all()));
            $agent->syncRoles('agent');

            return redirect()->route('agent.index')->with('success', 'Agent Created Succesfully');
        } else {
            return redirect()->route('agent.index')->with('error', 'Failed to Create Agent');
        }
    }

    public function show(string $id)
    {
        $agent = User::find($id);

        return view('agents.show', compact('agent'));
    }

    public function edit(string $id)
    {
        $agent = User::find($id);

        return view('agents.edit', compact('agent'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'branch' => 'required',
            'phone' => 'required',
        ]);
        $agent = User::find($id);
        if ($agent) {
            $updated = $agent->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'branch' => $request->branch,
                'phone' => $request->phone,
            ]);

            if ($updated) {
                return redirect()->route('agent.index')->with('success', 'Agent updated successfully');
            } else {
                return redirect()->route('agent.index')->with('error', 'Failed to update agent');
            }

        } else {
            return redirect()->route('agent.index')->with('error', 'Agent not found');
        }
    }

    public function destroy(string $id)
    {
        $agent = User::find($id);
        $user = User::where('email', $agent->email)->first();
        if ($agent) {
            if ($agent->delete()) {
                return redirect()->route('agent.index')->with('delete', 'Agent deleted successfully');
            } else {
                return redirect()->route('agent.index')->with('error', 'Failed to delete agent');
            }
        } else {
            return redirect()->route('agent.index')->with('error', 'Agent not found');
        }
    }
}

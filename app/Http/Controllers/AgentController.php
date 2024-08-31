<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AgentController extends Controller implements HasMiddleware
{
    public static function middleware() :array{
        return[
            new Middleware('permission:view agents',['only' => 'index']),
            new Middleware('permission:create agents',['only' => 'create']),
            new Middleware('permission:edit agents',['only' => 'edit']),
            new Middleware('permission:show agents',['only' => 'show']),
            new Middleware('permission:delete agents',['only' => 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        if ($request->filled('selected')) {
            $selectedId = $request->selected;

            $agents = Agent::whereIn('id', $selectedId)->get();
            $email_agent = $agents->pluck('email')->toArray();

            $users = User::whereIn('email', $email_agent)->delete();
            $agentsDelete = Agent::whereIn('id', $selectedId)->delete();

            return redirect()->back()->with('delete', 'Selected Agents deleted successfully');
        }

        $agents = Agent::paginate(10);
        return view('agents.index', compact('agents'));
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
            'owner_name' => 'required',
            'owner_phone' => 'required',
            'country' => 'required',
        ]);

        $agent = Agent::create([
            'branch_name' => $request->name,
            'branch_address' => $request->address,
            'owner_name' => $request->owner_name,
            'owner_phone' => $request->owner_phone,
            'email' => $request->email,
        ]);

        if ($agent) {
            $user = User::create([
                'name' => $request->owner_name,
                'email' => $request->email,
                'password' => $request->password,
                'address' => $request->address,
                'country' => $request->country,
                'phone' => $request->owner_phone,
            ]);
            if ($user) {
                $user->syncRoles('Agent');
                return redirect()->route('agent.index')->with('success', 'Agent created successfully');
            } else {
                return redirect()->route('agent.index')->with('error', 'Failed to create user for agent');
            }
        } else {
            return redirect()->route('agent.index')->with('error', 'Failed to create agent');
        }
    }

    public function show(string $id)
    {
        $agent = Agent::find($id);
       
        return view('agents.show', compact('agent'));
    }

    public function edit(string $id)
    {
        $agent = Agent::find($id);
        $hasStatus = $agent->branch_status;
        return view('agents.edit', compact('agent','hasStatus'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'owner_name' => 'required',
            'owner_phone' => 'required',
        ]);
        $agent = Agent::find($id);
        $agent_email = $agent->email;

        $user = User::where('email', $agent_email)->first();
        if ($user) {
            $user->update([
                'name' => $request->owner_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->owner_phone,
                
            ]);
        }
        if ($agent) {
            $updated = $agent->update([
                'branch_name' => $request->name,
                'email' => $request->email,
                'branch_address' => $request->address,
                'owner_name' => $request->owner_name,
                'owner_phone' => $request->owner_phone,
                'branch_status' => $request->branch_status
            ]);

            if ($updated && $user) {
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
        $agent = Agent::find($id);
        $user = User::where('email', $agent->email)->first();
        if ($agent && $user) {
            if ($agent->delete() && $user->delete()) {
                return redirect()->route('agent.index')->with('delete', 'Agent deleted successfully');
            } else {
                return redirect()->route('agent.index')->with('error', 'Failed to delete agent');
            }
        } else {
            return redirect()->route('agent.index')->with('error', 'Agent not found');
        }
    }
}

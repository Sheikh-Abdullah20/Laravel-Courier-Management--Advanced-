<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreationMail;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view users', ['only' => 'index']),
            new Middleware('permission:create users', ['only' => 'create']),
            new Middleware('permission:edit users', ['only' => 'edit']),
            new Middleware('permission:show users', ['only' => 'show']),
            new Middleware('permission:delete users', ['only' => 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        if ($request->filled('selected')) {
            $selectedId = $request->selected;
            $users = User::whereIn('id', $selectedId)->delete();
            if ($users) {
                return redirect()->back()->with('delete', 'Selected Users Has Been Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
        }
        $search = $request->search;
        $users = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'user');

        })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                        // ->orWhere('phone', 'like', '%'.$search.'%');
                });

            })
            ->paginate(10);

        return view('users.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //    return $request->role;
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'dob' => 'required',
        ]);
        // return $validatedData;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);

        if ($user) {
            $mail = Mail::to($request->email)->send(new AccountCreationMail($request->all()));
            $user->syncRoles('user');

            return redirect()->route('user.index')->with('success', 'User Has Been Created Successfully');
        } else {
            return redirect()->route('user.index')->with('error', 'User Creation Failed');
        }
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $agent = Agent::where('email', $user->email)->first();
        $roles = Role::all();
        $hasRole = $user->roles->pluck('name');

        return view('users.edit', compact('user', 'roles', 'agent', 'hasRole'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($id);
        if ($user) {
            $updated = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'city' => $request->city,
            ]);

            if ($updated) {
                return redirect()->route('user.index')->with('success', 'User Has Been Updated Successfully');
            } else {
                return redirect()->route('user.index')->with('error', 'User Updating Failed');
            }
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return redirect()->route('user.index')->with('delete', 'User Has Been Deleted Successfully');
        } else {
            return redirect()->route('user.index')->with('error', 'User Deletion Failed');
        }
    }
}

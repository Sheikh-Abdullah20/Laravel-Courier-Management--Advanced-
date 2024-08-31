<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

       $validatedData =  $request->validate([
            'name' => 'required', 'string', 'max:255',
            'address' => 'required',
            'phone' => 'required|numeric',
            'country' => 'required',
            'dob' => 'required|date',
            'email' => 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class,
            'password' => 'required', 'confirmed', Rules\Password::defaults(),
        ]);
        // return $validatedData['dob'];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success','Welcome Back  ' . Auth::user()->name);
    }
}

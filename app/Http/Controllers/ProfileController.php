<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profile Has Been Updated Successfully');
    }

    /**
     * Delete the user's account.
     */
   public function accountDelete(){
    return view('profile.partials.account-delete');
   }

   public function destroy(Request $request){
    // return $request->password;
    $request->validate([
        'password' => 'required|current_password'
    ]);
    $user = Auth::user();
    if(Hash::check($request->password,$user->password)){
        $delete = User::where('id',$user->id)->first();
        $delete->delete();
        return redirect()->route('login')->with('delete','Your Account Has Been Deleted');
    }else{
        return redirect()->back()->with('error','Something Went Wrong');
    }
   }
}

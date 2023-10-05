<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }
    public function updatePassword(Request $request, $id)
{
    $request->validate([
        'password' => 'required',
        'newpassword' => 'required|string|min:8|confirmed',
    ]);

    // Check if the current password matches the user's actual password
    if (Hash::check($request->password, Auth::user()->password)) {
        // Update the user's password
        Auth::user()->update([
            'password' => bcrypt($request->newpassword),
        ]);

        // Redirect back with a success message
        return redirect()->route('dashboard.profile.index')->with('success', 'Password Berhasil Di Ganti.');
    }

    // If the current password doesn't match, redirect back with an error message
    return redirect()->back()->with('error', 'Password Tidak Sama.');
}

}

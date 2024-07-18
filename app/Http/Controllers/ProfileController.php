<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $title = 'Profile';
        $user = Auth::user();
        return view('profile.index', compact('user', 'title'));
    }

    public function edit()
    {
        $title = 'Edit Profile';
        $user = Auth::user();
        // Assuming you have a view named 'profile.edit'
        return view('profile.edit', compact('user', 'title'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // Validate and update user profile
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'nip' => 'required|string|max:20',
            'photo' => 'nullable|image|max:2048', // Validation for the photo
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nip = $request->nip;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}

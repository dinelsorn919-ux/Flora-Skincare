<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    // Admin: Display all users list
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Display user profile details (Show / Index)
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    // Display profile edit form
    public function edit()
    {
        return view('profile.edit');
    }

    // Update profile information, password, and avatar image
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Handle Avatar Image Upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Handle Password Update
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('status', 'Profile updated successfully.');
    }

    // Admin: Delete a user account
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('status', 'You cannot delete your own admin account.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return back()->with('status', 'User deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
   {
    $users = User::select('id', 'name', 'email', 'role')->paginate(10);
    return view('admin.users.index', compact('users'));
   }

   public function destroy($id)
{
    $user = User::findOrFail($id);

    // ការពារកុំឱ្យ Admin លុបគណនីខ្លួនឯង
    if (auth()->id() === $user->id) {
        return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_pembeli' => User::where('role', 'pembeli')->count(),
            'total_penjual' => User::where('role', 'penjual')->count(),
            'total_admin' => User::where('role', 'admin')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display all users
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display specific user
     */
    public function showUser(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,penjual,pembeli',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', 'Role user berhasil diupdate.');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Ban/Unban user
     */
    public function toggleUserStatus(User $user)
    {
        // Note: You'll need to add 'is_active' column to users table first
        // This is just an example structure

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menonaktifkan akun sendiri.');
        }

        // Toggle logic here
        // $user->update(['is_active' => !$user->is_active]);

        return back()->with('success', 'Status user berhasil diupdate.');
    }
}

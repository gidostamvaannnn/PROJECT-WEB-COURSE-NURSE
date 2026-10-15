<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->with('profile');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhereHas('profile', function ($pq) use ($search) {
                      $pq->where('full_name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['profile', 'videoProgress.video.course', 'questionnaireAttempts.questionnaire', 'dailyProgress', 'certificates']);

        return view('admin.users.show', compact('user'));
    }

    public function verify(User $user)
    {
        $user->update(['status' => 'verified']);
        return back()->with('success', 'User berhasil diverifikasi.');
    }

    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', 'User ditolak.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}

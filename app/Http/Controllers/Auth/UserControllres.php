<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function allUser()
    {
        $users = User::all();
        return view('dashboard.categories.users', compact('users'));
    }

    // دالة لحذف مستخدم

    public function deleteUser($id)
    {
        // تحقق إذا كان المستخدم الحالي "سوبر أدمن"
        $user = Auth::user();
        if (!$user->isSuperAdmin()) {
            return redirect()->route('home')->with('error', 'You do not have permission to delete users.');
        }

        // العثور على المستخدم المطلوب حذفه
        $userToDelete = User::find($id);
        if (!$userToDelete) {
            return redirect()->route('home')->with('error', 'User not found.');
        }

        // لا يمكن للسوبر أدمن حذف نفسه
        if ($userToDelete->id === $user->id) {
            return redirect()->route('home')->with('error', 'You cannot delete yourself.');
        }

        // حذف المستخدم
        $userToDelete->delete();

        return redirect()->route('home')->with('success', 'User deleted successfully.');
    }
}

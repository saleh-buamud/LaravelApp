<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Display a list of all admins
    public function allAdmin()
    {
        $admins = Admin::paginate(10); // Paginate admins, 10 per page
        return view('dashboard.categories.adminAll', compact('admins'));
    }

    // Display the create admin form
    public function create()
    {
        return view('admin.create');
    }

    // Store a new admin in the database
    public function store(Request $request)
    {
        // Check if the current admin has permission to create users
        if (!auth()->guard('admin')->user()->can_create_users) {
            return redirect()->route('dashboard.allAdmin')->with('error', 'You do not have permission to create users.');
        }

        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new admin
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to the all admins page with a success message
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin created successfully!');
    }

    // Display the edit admin form
    public function edit($id)
    {
        $admin = Admin::findOrFail($id); // Find admin by ID
        return view('admin.edit', compact('admin'));
    }

    // Update admin information
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        // Find the admin to update
        $admin = Admin::findOrFail($id);

        // Update the admin's information
        $admin->name = $request->name;
        $admin->email = $request->email;

        // If a password is provided, update it
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Update 'is_admin' and 'can_create_users' values
        $admin->is_admin = $request->has('is_admin') ? $request->is_admin : $admin->is_admin;

        // Save the updated admin
        $admin->save();

        // Redirect to the all admins page with a success message
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin updated successfully!');
    }

    // Delete an admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id); // Find the admin by ID
        $admin->delete(); // Delete the admin
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin deleted successfully!');
    }
}

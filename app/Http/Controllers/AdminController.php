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
        // Paginate admins for display in the view
        $admins = Admin::paginate(10); // Changed the pagination to 10 for better usability
        return view('dashboard.categories.adminAll', compact('admins'));
    }

    // Show the form to create a new admin
    public function create()
    {
        return view('admin.create');
    }

    // Store a new admin in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new admin record
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to the allAdmin page with a success message
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin created successfully!');
    }

    // Show the form to edit an existing admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id); // Retrieve the admin record or fail
        return view('admin.edit', compact('admin'));
    }

    // Update an existing admin's information
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id, // Exclude current admin's email
            'password' => 'nullable|string|min:8|confirmed', // Password is optional during update
            'is_admin' => 'nullable|boolean', // Make sure it's either true or false
        ]);

        // Find the admin record to update
        $admin = Admin::findOrFail($id);

        // Update the admin's details
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Update is_admin flag if provided
        $admin->is_admin = $request->has('is_admin') ? $request->is_admin : $admin->is_admin;
        $admin->save(); // Save the changes to the database

        // Redirect to the allAdmin page with a success message
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin updated successfully!');
    }

    // Delete an admin record
    public function destroy($id)
    {
        // Find the admin to delete
        $admin = Admin::findOrFail($id);

        // Delete the admin record
        $admin->delete();

        // Redirect to the allAdmin page with a success message
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin deleted successfully!');
    }
}

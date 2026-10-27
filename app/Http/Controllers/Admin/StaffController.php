<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $staff = Staff::all();
        return view('admin.staff.index', compact('staff')); // Asumsi Anda akan membuat file view ini
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
return view('admin.staff.create');    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('staff/photos', 'public');
        }

        Staff::create($data);
        return redirect()->route('admin.staff.index')->with('success', 'Data Guru berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
       $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $staff->name = $request->name;
        $staff->position = $request->position;

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $staff->photo = $request->file('photo')->store('staff_photos', 'public');
        }

        $staff->save();

        return redirect()->route('admin.staff.index')->with('success', 'Data Staff berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        if ($staff->photo) Storage::disk('public')->delete($staff->photo);
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Data Guru dihapus.');
    }
}

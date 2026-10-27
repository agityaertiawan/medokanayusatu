<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Mengambil data prestasi diurutkan dari yang terbaru (paginasi 10 data per halaman)
        $achievements = Achievement::latest()->paginate(10);
        
        return view('admin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.achievements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data
        $validated = $request->validate([
            'student_name'     => 'required|string|max:255',
            'competition_name' => 'required|string|max:255',
            'level'            => 'required|string',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // 2. Upload Foto Siswa jika ada
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('achievements', 'public');
        }

        // 3. Simpan ke Database
        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Data prestasi murid berhasil ditambahkan!');
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
    public function edit(Achievement $achievement)
    {
      return view('admin.achievements.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $achievement)
    {
        // 1. Validasi Input Data
        $validated = $request->validate([
            'student_name'     => 'required|string|max:255',
            'competition_name' => 'required|string|max:255',
            'level'            => 'required|string',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Proses foto baru jika diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada di storage
            if ($achievement->photo && Storage::disk('public')->exists($achievement->photo)) {
                Storage::disk('public')->delete($achievement->photo);
            }

            // Simpan foto baru
            $validated['photo'] = $request->file('photo')->store('achievements', 'public');
        }

        // 3. Update Record di Database
        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Data prestasi murid berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        // Hapus file foto terkait dari storage jika ada
        if ($achievement->photo && Storage::disk('public')->exists($achievement->photo)) {
            Storage::disk('public')->delete($achievement->photo);
        }

        // Hapus data dari DB
        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Data prestasi murid berhasil dihapus!');
    }
}

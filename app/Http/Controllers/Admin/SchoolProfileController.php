<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit(){
        // Ambil data profil pertama (ID 1), atau buat data default jika tabel masih kosong
        $profile = SchoolProfile::firstOrCreate(
            ['id' => 1],
            [
                'school_name'        => 'SDN Medokan Ayu I/270 Surabaya',
                'headmaster_name'    => 'Selamet Pujiono, S.Pd',
                'headmaster_welcome' => 'Selamat datang di website resmi SDN Medokan Ayu I/270 Surabaya. Kami berkomitmen memberikan pendidikan berkualitas untuk mencetak generasi berkarakter.',
                'vision'             => 'Terwujudnya peserta didik yang bertaqwa, berprestasi, berkarakter, dan berwawasan lingkungan.',
                'mission'            => "1. Meningkatkan keimanan dan ketaqwaan kepada Tuhan YME.\n2. Mengembangkan potensi akademik dan non-akademik siswa.\n3. Membiasakan perilaku hidup bersih dan ramah lingkungan.",
                'history'            => 'SDN Medokan Ayu I/270 didirikan untuk melayani kebutuhan pendidikan dasar berkualitas di wilayah Rungkut, Kota Surabaya.',
                'address'            => 'Jl. Medokan Asri No. 1, Medokan Ayu, Kec. Rungkut, Surabaya, Jawa Timur',
                'phone'              => '(031) 8700000',
                'email'              => 'info@sdnmedokanayu1.sch.id',
            ]
        );

        return view('admin.profile.school', compact('profile'));
    }
    public function update(Request $request)
    {
        $profile = SchoolProfile::firstOrFail();

        // Validasi input data dari form
        $validated = $request->validate([
            'school_name'        => 'required|string|max:255',
            'headmaster_name'    => 'required|string|max:255',
            'headmaster_welcome' => 'required|string',
            'vision'             => 'required|string',
            'mission'            => 'required|string',
            'history'            => 'required|string',
            'address'            => 'required|string',
            'phone'              => 'required|string|max:50',
            'email'              => 'required|email|max:255',
            'headmaster_photo'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Ganti foto Kepala Sekolah jika ada upload file baru
        if ($request->hasFile('headmaster_photo')) {
            // Hapus foto lama dari storage jika ada
            if ($profile->headmaster_photo && Storage::disk('public')->exists($profile->headmaster_photo)) {
                Storage::disk('public')->delete($profile->headmaster_photo);
            }
            // Simpan foto baru ke folder 'storage/app/public/profile'
            $validated['headmaster_photo'] = $request->file('headmaster_photo')->store('profile', 'public');
        }

        // Simpan perubahan ke database
        $profile->update($validated);

        return redirect()->back()->with('success', 'Profil sekolah berhasil diperbarui!');
    }

}

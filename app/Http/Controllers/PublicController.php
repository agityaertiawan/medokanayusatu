<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Staff;
use App\Models\Achievement;
use App\Models\SchoolProfile;


class PublicController extends Controller
{
    /**
     * Menampilkan Halaman Utama / Beranda Publik (Landing Page)
     */
    public function index()
    {
        // 1. Mengambil Data Profil Sekolah
        // Jika database profil masih kosong, kita siapkan nilai bawaan (fallback) agar web tidak crash
        $profile = SchoolProfile::first() ?? new SchoolProfile([
            'school_name'        => 'SDN Medokan Ayu I/270 Surabaya',
            'headmaster_name'    => 'Selamet Pujiono, S.Pd',
            'headmaster_welcome' => 'Selamat datang di website resmi SDN Medokan Ayu I/270 Surabaya. Kami berkomitmen memberikan pendidikan terbaik untuk putra-putri Anda.',
            'vision'             => 'Terwujudnya peserta didik yang bertaqwa, berprestasi, berkarakter, dan berwawasan lingkungan.',
            'mission'            => "1. Meningkatkan keimanan dan ketaqwaan kepada Tuhan YME.\n2. Mengembangkan potensi akademik dan non-akademik siswa.",
            'history'            => 'SDN Medokan Ayu I/270 Surabaya berdiri sejak lama untuk melayani kebutuhan pendidikan di wilayah Rungkut, Surabaya.',
            'address'            => 'Jl. Raya Medokan Ayu no.7, Medokan Ayu, Kec. Rungkut, Surabaya, Jawa Timur',
            'phone'              => '031-8706763',
            'email'              => 'medokanayusatu@gmail.com',
        ]);

        // 2. Mengambil 6 Berita Terbaru saja untuk dipajang di halaman depan (limit 6)
        $latestNews = News::latest()->take(6)->get();

        // 3. Mengambil Seluruh Data Guru & Karyawan
        $staffs = Staff::all();

        // 4. Mengambil Seluruh Data Murid Berprestasi (diurutkan dari yang terbaru)
        $achievements = Achievement::latest()->get();

        // 5. Lempar semua variabel data ke view 'welcome.blade.php'
        return view('welcome', compact('profile', 'latestNews', 'staffs', 'achievements'));
    }
}
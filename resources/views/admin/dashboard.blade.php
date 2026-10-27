<x-app-layout>
    <!-- Header Halaman -->
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-red-700 leading-tight flex items-center">
            <span class="mr-2">🎛️</span> {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Ucapan Selamat Datang -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl mb-8 border-l-8 border-red-500">
                <div class="p-6 text-gray-900 md:flex md:items-center md:justify-between">
                    <div>
                        <h3 class="text-xl font-extrabold text-gray-800">Selamat datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-gray-600 mt-1">Ini adalah pusat kendali website SDN Medokan Ayu I/270 Surabaya.</p>
                    </div>
                    <div class="mt-4 md:mt-0 bg-red-100 text-red-800 px-4 py-2 rounded-lg font-semibold text-sm inline-block">
                        📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>
            </div>

            <!-- GRID MENU UTAMA -->
            <h4 class="text-lg font-bold text-red-800 mb-4 px-2">📂 Kelola Konten Website</h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                <!-- MENU 1: PROFIL SEKOLAH -->
                <a href="{{ route('admin.school_profile.edit') }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
                            🏫
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 group-hover:text-blue-600">Profil Sekolah</h5>
                        <p class="text-sm text-gray-500 mt-2">Ubah Visi, Misi, Sejarah, & Sambutan Kepala Sekolah.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center group-hover:bg-blue-50 transition-colors">
                        <span class="text-sm font-semibold text-blue-600">Edit Profil</span>
                        <span class="text-blue-600">&rarr;</span>
                    </div>
                </a>

                <!-- MENU 2: MANAJEMEN BERITA -->
                <a href="{{ route('admin.news.index') }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
                            📰
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 group-hover:text-yellow-600">Berita & Kegiatan</h5>
                        <p class="text-sm text-gray-500 mt-2">Total <span class="font-bold text-gray-900">{{ $totalNews }}</span> berita terpublikasi.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center group-hover:bg-yellow-50 transition-colors">
                        <span class="text-sm font-semibold text-yellow-600">Kelola Berita</span>
                        <span class="text-yellow-600">&rarr;</span>
                    </div>
                </a>

                <!-- MENU 3: PRESTASI SISWA -->
                <a href="{{ route('admin.achievements.index') }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
                            🏆
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 group-hover:text-red-600">Prestasi Siswa</h5>
                        <p class="text-sm text-gray-500 mt-2">Total <span class="font-bold text-gray-900">{{ $totalAchievements }}</span> data siswa berprestasi.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center group-hover:bg-red-50 transition-colors">
                        <span class="text-sm font-semibold text-red-600">Kelola Prestasi</span>
                        <span class="text-red-600">&rarr;</span>
                    </div>
                </a>

                <!-- MENU 4: GURU & STAFF -->
                <a href="{{ route('admin.staff.index') }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
                            👨‍🏫
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 group-hover:text-green-600">Guru & Staff</h5>
                        <p class="text-sm text-gray-500 mt-2">Total <span class="font-bold text-gray-900">{{ $totalStaff }}</span> tenaga pendidik & kependidikan.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center group-hover:bg-green-50 transition-colors">
                        <span class="text-sm font-semibold text-green-600">Kelola Guru</span>
                        <span class="text-green-600">&rarr;</span>
                    </div>
                </a>

            </div>

            <!-- PENGATURAN TAMBAHAN -->
            <h4 class="text-lg font-bold text-gray-800 mb-4 px-2">⚙️ Pengaturan Sistem</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- MENU: PENGATURAN AKUN -->
                <a href="{{ route('profile.edit') }}" class="flex items-center bg-white p-5 rounded-2xl shadow-sm hover:shadow-md border border-gray-200 transition-all">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-2xl mr-4">
                        🔐
                    </div>
                    <div>
                        <h5 class="font-bold text-gray-900">Pengaturan Akun Admin</h5>
                        <p class="text-sm text-gray-500">Ubah email dan kata sandi login Anda.</p>
                    </div>
                </a>

                <!-- MENU: LIHAT WEBSITE PUBLIK -->
                <a href="{{ route('home') }}" target="_blank" class="flex items-center bg-white p-5 rounded-2xl shadow-sm hover:shadow-md border border-gray-200 transition-all">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-2xl mr-4">
                        🌐
                    </div>
                    <div>
                        <h5 class="font-bold text-indigo-700">Lihat Website Publik</h5>
                        <p class="text-sm text-gray-500">Buka halaman beranda sekolah di tab baru.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->school_name ?? 'SDN Medokan Ayu I/270' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- NAVBAR -->
    <nav class="bg-blue-700 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- Logo Tut Wuri Handayani (Bisa diganti dengan logo sekolah) -->
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-bold tracking-wider">{{ $profile->school_name ?? 'SDN Medokan Ayu' }}</h1>
            </div>
            <div class="hidden md:flex space-x-6 font-semibold">
                <a href="#beranda" class="hover:text-yellow-300 transition">Beranda</a>
                <a href="#profil" class="hover:text-yellow-300 transition">Profil</a>
                <a href="#berita" class="hover:text-yellow-300 transition">Berita</a>
                <a href="#prestasi" class="hover:text-yellow-300 transition">Prestasi</a>
                <a href="#guru" class="hover:text-yellow-300 transition">Guru & Staff</a>
            </div>
            <!-- Tombol Login Admin -->
            <div>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-blue-900 px-4 py-2 rounded-full font-bold hover:bg-yellow-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-700 px-4 py-2 rounded-full font-bold hover:bg-gray-100">Login Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (Sambutan Kepala Sekolah) -->
    <section id="beranda" class="bg-blue-50 py-16 md:py-24">
        <div class="container mx-auto px-4 flex flex-col-reverse md:flex-row items-center gap-10">
            <div class="w-full md:w-1/2 space-y-6">
                <h2 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                    Selamat Datang di <br> <span class="text-yellow-500">{{ $profile->school_name ?? 'Website Resmi Sekolah' }}</span>
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed italic border-l-4 border-blue-500 pl-4">
                    "{{ $profile->headmaster_welcome ?? 'Selamat datang di website kami.' }}"
                </p>
                <div class="text-gray-900 font-bold">
                    - {{ $profile->headmaster_name ?? 'Kepala Sekolah' }}
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
                @if(!empty($profile->headmaster_photo))
                    <img src="{{ asset('storage/'.$profile->headmaster_photo) }}" alt="Kepala Sekolah" class="w-64 h-64 md:w-80 md:h-80 object-cover rounded-full shadow-2xl border-8 border-white">
                @else
                    <!-- Ilustrasi Default jika belum ada foto -->
                    <img src="https://ui-avatars.com/api/?name=Kepala+Sekolah&size=300&background=0D8ABC&color=fff" class="rounded-full shadow-xl border-4 border-white">
                @endif
            </div>
        </div>
    </section>

    <!-- PROFIL (Visi & Misi) -->
    <section id="profil" class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-blue-900 mb-10">Visi & Misi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left">
                <div class="bg-blue-50 p-8 rounded-2xl shadow-sm border border-blue-100">
                    <h4 class="text-2xl font-bold text-yellow-600 mb-4 flex items-center"><span class="text-3xl mr-2">🌟</span> Visi</h4>
                    <p class="text-gray-700 text-lg leading-relaxed">{{ $profile->vision ?? 'Belum ada data visi.' }}</p>
                </div>
                <div class="bg-blue-50 p-8 rounded-2xl shadow-sm border border-blue-100">
                    <h4 class="text-2xl font-bold text-yellow-600 mb-4 flex items-center"><span class="text-3xl mr-2">🎯</span> Misi</h4>
                    <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $profile->mission ?? 'Belum ada data misi.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BERITA TERBARU -->
    <section id="berita" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-blue-900">Berita & Kegiatan Terbaru</h3>
                <p class="text-gray-600 mt-2">Informasi terkini seputar kegiatan di sekolah kami.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestNews as $news)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($news->image)
                        <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tanpa Gambar</div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs font-bold text-blue-600 mb-2">{{ $news->created_at->format('d M Y') }}</div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $news->title }}</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($news->content), 100) }}
                        </p>
                        <a href="{{ route('news.show', $news->id) }}" class="text-blue-700 font-bold hover:underline flex items-center">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500 py-10">Belum ada berita yang dipublikasikan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- PRESTASI SISWA -->
    <section id="prestasi" class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-blue-900 mb-10">🏆 Siswa Berprestasi</h3>
            <div class="flex overflow-x-auto space-x-6 pb-6 snap-x justify-start md:justify-center">
                @forelse($achievements as $achieve)
                <div class="min-w-[250px] bg-yellow-50 rounded-xl p-6 shadow border border-yellow-200 snap-center">
                    <img src="{{ $achieve->photo ? asset('storage/'.$achieve->photo) : 'https://ui-avatars.com/api/?name='.urlencode($achieve->student_name) }}" class="w-24 h-24 rounded-full mx-auto object-cover mb-4 shadow">
                    <h4 class="font-bold text-lg text-gray-900">{{ $achieve->student_name }}</h4>
                    <p class="text-sm text-blue-700 font-semibold mb-1">{{ $achieve->competition_name }}</p>
                    <span class="inline-block bg-yellow-400 text-yellow-900 text-xs px-3 py-1 rounded-full font-bold">{{ $achieve->level }}</span>
                </div>
                @empty
                <p class="text-gray-500 w-full">Belum ada data siswa berprestasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- GURU & STAFF -->
    <section id="guru" class="py-16 bg-blue-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-10 text-yellow-400">Tenaga Pendidik & Kependidikan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($staffs as $staff)
                <div class="bg-blue-800 rounded-xl p-4 shadow-lg flex flex-col items-center text-center">
                    <img src="{{ $staff->photo ? asset('storage/'.$staff->photo) : 'https://ui-avatars.com/api/?name='.urlencode($staff->name) }}" class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover mb-3 border-2 border-yellow-400">
                    <h4 class="font-bold text-sm md:text-base">{{ $staff->name }}</h4>
                    <p class="text-xs text-blue-200 mt-1">{{ $staff->position }}</p>
                </div>
                @empty
                <p class="col-span-full text-blue-300">Belum ada data guru.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="text-white text-lg font-bold mb-4">SDN Medokan Ayu I/270</h4>
                <p class="text-sm leading-relaxed">{{ $profile->history ?? 'Sekolah dasar negeri yang berdedikasi tinggi untuk pendidikan Indonesia.' }}</p>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm">
                    <li>📍 {{ $profile->address ?? 'Alamat belum diatur' }}</li>
                    <li>📞 {{ $profile->phone ?? '-' }}</li>
                    <li>✉️ {{ $profile->email ?? '-' }}</li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Lokasi</h4>
                <!-- Anda bisa mengganti link src iframe ini dengan link Google Maps asli SDN Medokan Ayu -->
                <div class="bg-gray-700 w-full h-32 rounded-lg flex items-center justify-center text-sm">
                    Peta Google Maps
                </div>
            </div>
        </div>
        <div class="text-center text-sm mt-10 border-t border-gray-700 pt-6">
            &copy; {{ date('Y') }} {{ $profile->school_name ?? 'SDN Medokan Ayu' }}. All Rights Reserved. <br>
            Developed with Laravel & Tailwind CSS.
        </div>
    </footer>

</body>
</html>
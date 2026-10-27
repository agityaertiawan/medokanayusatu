<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title img src="{{ asset('logoMa1.png') }}" class="h-5 w-5" alt="logo">{{ $profile->school_name ?? 'SDN Medokan Ayu I/270' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- NAVBAR (Merah Ceria) -->
    <nav class="bg-red-600 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- Logo Tut Wuri Handayani -->
                <img src="{{ asset('logoMa1.png') }}" alt="Logo" class="w-10 h-10 bg-white rounded-full p-1 shadow">
                <h1 class="text-xl font-bold tracking-wider">{{ $profile->school_name ?? 'SDN Medokan Ayu' }}</h1>
            </div>
            <div class="hidden md:flex space-x-6 font-semibold">
                <a href="#beranda" class="hover:text-yellow-300 transition-colors">Beranda</a>
                <a href="#profil" class="hover:text-yellow-300 transition-colors">Profil</a>
                <a href="#berita" class="hover:text-yellow-300 transition-colors">Berita</a>
                <a href="#prestasi" class="hover:text-yellow-300 transition-colors">Prestasi</a>
                <a href="#guru" class="hover:text-yellow-300 transition-colors">Guru & Staff</a>
            </div>
            <!-- Tombol Login Admin -->
            {{-- <div>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-red-900 px-5 py-2 rounded-full font-bold hover:bg-yellow-300 shadow-md transition-transform transform hover:scale-105">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-red-600 px-5 py-2 rounded-full font-bold hover:bg-gray-100 shadow-md transition-transform transform hover:scale-105">Login Admin</a>
                @endauth
            </div> --}}
        </div>
    </nav>

    <!-- HERO SECTION (Sambutan Kepala Sekolah - Background Merah Muda/Soft Pink) -->
    <section id="beranda" class="bg-gradient-to-b from-red-50 to-white py-16 md:py-24 relative overflow-hidden">
        <!-- Ornamen Lingkaran Dekoratif -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-red-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>

        <div class="container mx-auto px-4 flex flex-col-reverse md:flex-row items-center gap-10 relative z-10">
            <div class="w-full md:w-1/2 space-y-6">
                <h2 class="text-4xl md:text-5xl font-extrabold text-red-800 leading-tight drop-shadow-sm">
                    Selamat Datang di <br> <span class="text-yellow-500 drop-shadow-md">{{ $profile->school_name ?? 'Website Resmi Sekolah' }}</span>
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed italic border-l-4 border-red-500 pl-4 bg-white bg-opacity-60 p-3 rounded-r-lg shadow-sm">
                    "{{ $profile->headmaster_welcome ?? 'Selamat datang di website kami.' }}"
                </p>
                <div class="text-gray-900 font-bold flex items-center">
                    <span class="w-8 h-1 bg-red-500 mr-3 rounded-full"></span> 
                    {{ $profile->headmaster_name ?? 'Kepala Sekolah' }}
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
                @if(!empty($profile->headmaster_photo))
                    <img src="{{ asset('storage/'.$profile->headmaster_photo) }}" alt="Kepala Sekolah" class="w-64 h-64 md:w-80 md:h-80 object-cover rounded-full shadow-2xl border-8 border-white ring-4 ring-red-200">
                @else
                    <img src="https://ui-avatars.com/api/?name=Kepala+Sekolah&size=300&background=EF4444&color=fff" class="rounded-full shadow-xl border-8 border-white ring-4 ring-red-200">
                @endif
            </div>
        </div>
    </section>

    <!-- PROFIL (Visi & Misi - Kartu Timbul) -->
    <section id="profil" class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <div class="inline-block bg-red-100 text-red-700 font-bold px-4 py-1 rounded-full mb-3 text-sm">PROFIL KAMI</div>
            <h3 class="text-3xl font-extrabold text-gray-900 mb-10">Visi & Misi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left">
                <!-- Box Visi -->
                <div class="bg-white p-8 rounded-3xl shadow-xl border-t-8 border-red-500 hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 text-red-100 text-9xl opacity-30 -mt-8 -mr-8">🌟</div>
                    <h4 class="text-2xl font-bold text-red-700 mb-4 flex items-center relative z-10"><span class="text-3xl mr-2">🌟</span> Visi</h4>
                    <p class="text-gray-700 text-lg leading-relaxed relative z-10">{{ $profile->vision ?? 'Belum ada data visi.' }}</p>
                </div>
                <!-- Box Misi -->
                <div class="bg-white p-8 rounded-3xl shadow-xl border-t-8 border-yellow-400 hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 text-yellow-100 text-9xl opacity-30 -mt-8 -mr-8">🎯</div>
                    <h4 class="text-2xl font-bold text-red-700 mb-4 flex items-center relative z-10"><span class="text-3xl mr-2">🎯</span> Misi</h4>
                    <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line relative z-10">{{ $profile->mission ?? 'Belum ada data misi.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BERITA TERBARU (Desain Kartu) -->
    <section id="berita" class="py-16 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-block bg-red-100 text-red-700 font-bold px-4 py-1 rounded-full mb-3 text-sm">INFORMASI</div>
                <h3 class="text-3xl font-extrabold text-gray-900">Berita & Kegiatan Terbaru</h3>
                <p class="text-gray-600 mt-2">Kabar terkini dari sekolah tercinta kita.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestNews as $news)
                <div class="bg-white rounded-3xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 group border border-gray-100">
                    <div class="relative overflow-hidden">
                        @if($news->image)
                            <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-48 bg-red-50 flex items-center justify-center text-red-400 font-medium">Tanpa Gambar</div>
                        @endif
                        <!-- Badge Tanggal -->
                        <div class="absolute top-4 left-4 bg-white text-red-600 font-bold px-3 py-1 rounded-full shadow text-xs">
                            {{ $news->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-600 transition-colors">{{ $news->title }}</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($news->content), 100) }}
                        </p>
                        <a href="{{ route('news.show', $news->id) }}" class="text-red-600 font-bold hover:text-red-800 flex items-center">
                            Baca Selengkapnya 
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500 py-10 bg-white rounded-2xl shadow-sm border border-dashed border-gray-300">Belum ada berita yang dipublikasikan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- PRESTASI SISWA (Kuning Ceria) -->
    <section id="prestasi" class="py-16 bg-white border-t border-red-100">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-extrabold text-gray-900 mb-10">🏆 Siswa Berprestasi</h3>
            <div class="flex overflow-x-auto space-x-6 pb-6 snap-x justify-start md:justify-center px-4">
                @forelse($achievements as $achieve)
                <div class="min-w-[250px] bg-gradient-to-b from-yellow-50 to-white rounded-3xl p-6 shadow-md border border-yellow-200 snap-center hover:-translate-y-2 transition-transform">
                    <img src="{{ $achieve->photo ? asset('storage/'.$achieve->photo) : 'https://ui-avatars.com/api/?name='.urlencode($achieve->student_name).'&background=FCD34D&color=fff' }}" class="w-24 h-24 rounded-full mx-auto object-cover mb-4 shadow-lg ring-4 ring-yellow-200">
                    <h4 class="font-bold text-lg text-gray-900">{{ $achieve->student_name }}</h4>
                    <p class="text-sm text-red-600 font-bold mb-2">{{ $achieve->competition_name }}</p>
                    <span class="inline-block bg-yellow-400 text-yellow-900 text-xs px-3 py-1 rounded-full font-bold shadow-sm">{{ $achieve->level }}</span>
                </div>
                @empty
                <p class="text-gray-500 w-full">Belum ada data siswa berprestasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- GURU & STAFF (Merah Gelap Elegan tapi Ceria) -->
    <section id="guru" class="py-16 bg-red-700 text-white relative overflow-hidden">
        <!-- Ornamen Background -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600 rounded-full mix-blend-multiply filter blur-3xl opacity-50 transform translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-red-800 rounded-full mix-blend-multiply filter blur-3xl opacity-50 transform -translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h3 class="text-3xl font-extrabold mb-10 text-yellow-300 drop-shadow-md">Tenaga Pendidik & Kependidikan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($staffs as $staff)
                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-3xl p-5 shadow-lg flex flex-col items-center text-center border border-red-500 hover:bg-opacity-20 transition duration-300">
                    <img src="{{ $staff->photo ? asset('storage/'.$staff->photo) : 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=fff&color=DC2626' }}" class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover mb-4 border-4 border-yellow-400 shadow-md">
                    <h4 class="font-bold text-sm md:text-base text-white">{{ $staff->name }}</h4>
                    <p class="text-xs text-red-200 mt-1 font-medium bg-red-800 px-2 py-1 rounded-md">{{ $staff->position }}</p>
                </div>
                @empty
                <p class="col-span-full text-red-200">Belum ada data guru.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FOOTER (Merah Marun) -->
    <footer class="bg-red-900 text-red-100 py-12">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-white p-2 rounded-full">
                        <img src="{{ asset('logoMa1.png') }}" class="w-8 h-8">
                    </div>
                    <h4 class="text-white text-xl font-bold">{{ $profile->school_name ?? 'SDN Medokan Ayu I/270' }}</h4>
                </div>
                <p class="text-sm leading-relaxed text-red-200">{{ $profile->history ?? 'Sekolah dasar negeri yang berdedikasi tinggi untuk mencerdaskan kehidupan bangsa dengan lingkungan belajar yang ceria dan menyenangkan.' }}</p>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-6 border-b border-red-700 pb-2 inline-block">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start">
                        <span class="text-xl mr-3">📍</span> 
                        <span class="mt-1">{{ $profile->address ?? 'Alamat belum diatur' }}</span>
                    </li>
                    <li class="flex items-center">
                        <span class="text-xl mr-3">📞</span> 
                        <span>{{ $profile->phone ?? '-' }}</span>
                    </li>
                    <li class="flex items-center">
                        <span class="text-xl mr-3">✉️</span> 
                        <span>{{ $profile->email ?? '-' }}</span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-6 border-b border-red-700 pb-2 inline-block">Lokasi</h4>
                <div class="bg-red-800 w-full h-32 rounded-2xl flex items-center justify-center text-sm border border-red-700 shadow-inner overflow-hidden">
                    <div class="text-center">
                        <p class="mb-2">🗺️ Area Peta Google Maps</p>
                        <div class="text-xs text-red-300"><div class="mapouter "><div class="gmap_canvas"><iframe class="gmap_iframe" width="600" height="450" src="https://www.google.com/maps?q=sdn+medokan+ayu+I%2F270&amp;z=14&amp;t=m&amp;hl=en&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.tiempodehoy.com/">tiempodehoy.com</a></div><style>.mapouter{position:relative;text-align:right;width:600px;height:450px}.gmap_canvas{overflow:hidden;background:none!important;width:600px;height:450px}.gmap_iframe{width:600px!important;height:450px!important}</style></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center text-sm mt-12 border-t border-red-800 pt-8 text-red-300 font-medium">
            &copy; {{ date('Y') }} {{ $profile->school_name ?? 'SDN Medokan Ayu' }}. All Rights Reserved. <br>
            <span class="text-xs opacity-75 mt-1 block">Dibuat dengan Laravel & Tailwind CSS</span>
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title ?? 'Detail Berita' }} - SDN Medokan Ayu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Navbar Sederhana -->
    <nav class="bg-red-600 text-white p-4 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl">🏫 SDN Medokan Ayu</h1>
            <a href="{{ url('/') }}" class="text-sm bg-white text-red-600 px-4 py-2 rounded-full font-semibold hover:bg-yellow-300 hover:text-red-800 transition">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </nav>

    <!-- Konten Berita -->
    <main class="max-w-4xl mx-auto mt-10 mb-20 px-4">
        <article class="bg-white rounded-3xl shadow-xl overflow-hidden">
            
            <!-- Gambar Berita (Cek apakah ada gambar di database) -->
            @if(isset($news->image) && $news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar Berita" class="w-full h-80 object-cover">
            @else
                <div class="w-full h-48 bg-gradient-to-r from-red-500 to-yellow-400 flex items-center justify-center">
                    <span class="text-white font-bold text-xl opacity-50">📰 Tidak ada gambar</span>
                </div>
            @endif

            <div class="p-8 md:p-12">
                <!-- Tanggal dan Kategori -->
                <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                    <span class="flex items-center">
                        📅 {{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('l, d F Y') }}
                    </span>
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full font-semibold text-xs">
                        Pengumuman Sekolah
                    </span>
                </div>

                <!-- Judul Berita (Sesuaikan 'title' dengan nama kolom di database Anda) -->
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                    {{ $news->title ?? 'Judul Berita' }}
                </h1>

                <!-- Garis Pembatas -->
                <hr class="border-t-2 border-gray-100 mb-8">

                <!-- Isi Berita (Sesuaikan 'content' dengan nama kolom di database Anda) -->
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($news->content ?? 'Isi berita belum tersedia.')) !!}
                </div>
            </div>
        </article>
    </main>

</body>
</html>
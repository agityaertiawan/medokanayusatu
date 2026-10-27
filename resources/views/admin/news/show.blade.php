<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - SDN Medokan Ayu I/270</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Header / Navbar Ringkas -->
    <nav class="bg-blue-700 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold flex items-center space-x-2">
                <span>&larr; Kembali ke Beranda</span>
            </a>
            <span class="text-sm font-semibold bg-blue-800 px-3 py-1 rounded-full">SDN Medokan Ayu I/270</span>
        </div>
    </nav>

    <main class="container mx-auto my-10 px-4 max-w-4xl">
        <article class="bg-white rounded-2xl shadow-lg p-6 md:p-10 border border-gray-100">
            <!-- Tanggal & Judul -->
            <div class="text-sm text-blue-600 font-bold mb-2">
                📅 Dipublikasikan pada {{ $news->created_at->translatedFormat('d F Y') }}
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $news->title }}
            </h1>

            <!-- Cover Gambar -->
            @if($news->image)
            <div class="mb-8 rounded-xl overflow-hidden shadow-md max-h-[450px]">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Isi Berita -->
            <div class="prose max-w-none text-gray-700 leading-relaxed text-lg space-y-4 mb-8 whitespace-pre-line">
                {{ $news->content }}
            </div>

            <!-- Box Download Lampiran PDF -->
            @if($news->pdf_attachment)
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl flex flex-col md:flex-row items-center justify-between gap-4 mt-8">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-red-100 rounded-lg text-red-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 01-2 2H3a1 1 0 110-2h2a1 1 0 001-1V4a1 1 0 011-1h6a1 1 0 011 1v8a1 1 0 001 1h2a1 1 0 110 2h-2a2 2 0 01-2-2V4a2 2 0 00-2-2H9z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Dokumen Lampiran Berita</h4>
                        <p class="text-sm text-gray-600">Unduh dokumen resmi berformat PDF terkait kegiatan ini.</p>
                    </div>
                </div>
                <a href="{{ route('news.download', $news->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow transition duration-200 whitespace-nowrap">
                    📥 Download PDF
                </a>
            </div>
            @endif
        </article>
    </main>

</body>
</html>
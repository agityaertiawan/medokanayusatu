<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Berita & Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- WIDGET AI ASSISTANT -->
<div class="mb-6 bg-indigo-50 border border-indigo-200 rounded-xl p-5 shadow-sm">
    <div class="flex items-center gap-2 mb-3">
        <span class="text-xl">✨</span>
        <h3 class="font-bold text-indigo-800">AI News Assistant </h3>
    </div>
    <p class="text-sm text-indigo-600 mb-3">Kehabisan ide? Ketik topik singkat, dan biarkan AI membuatkan draf beritanya untuk Anda.</p>
    
    <div class="flex gap-3">
        <input type="text" id="ai-prompt" placeholder="Contoh: Juara 1 Lomba Menggambar tingkat Kota Surabaya atas nama Budi..." 
               class="w-full rounded-lg border-indigo-300 focus:ring-indigo-500 text-sm py-2 px-3">
        
        <button type="button" onclick="generateNewsAI()" id="btn-ai" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-semibold transition whitespace-nowrap flex items-center justify-center min-w-[120px]">
            Generate
        </button>
    </div>
</div>
<!-- AKHIR WIDGET AI -->

                    {{-- Form wajib menggunakan enctype="multipart/form-data" untuk upload file --}}
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Judul Berita -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                            <input type="text" name="title" id="title-input" value="{{ old('title') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                placeholder="Masukkan judul berita atau kegiatan" required>
                            
                            {{-- Pesan Error Validasi --}}
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Konten Berita -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                            <textarea name="content" id="content-input" rows="6" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                placeholder="Tuliskan isi detail berita di sini..." required>{{ old('content') }}</textarea>
                            
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Upload Gambar (Cover) -->
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Cover Gambar (Opsional)</label>
                            <input type="file" name="image" id="image" accept="image/jpeg, image/png, image/jpg"
                                class="mt-1 block w-full text-sm text-gray-500
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700
                                       hover:file:bg-blue-100">
                            <p class="text-gray-400 text-xs mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                            
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Upload Lampiran PDF -->
                        <div class="mb-6">
                            <label for="pdf_attachment" class="block text-sm font-medium text-gray-700">Lampiran Dokumen PDF (Opsional)</label>
                            <input type="file" name="pdf_attachment" id="pdf_attachment" accept="application/pdf"
                                class="mt-1 block w-full text-sm text-gray-500
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-red-50 file:text-red-700
                                       hover:file:bg-red-100">
                            <p class="text-gray-400 text-xs mt-1">Format: PDF. Maksimal 10MB.</p>
                            
                            @error('pdf_attachment')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end mt-8 space-x-4">
                            <a href="{{ route('admin.news.index') }}" 
                               class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition shadow-sm text-sm font-medium">
                                Batal
                            </a>
                            <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition shadow-sm text-sm font-medium">
                                Simpan Berita
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
function generateNewsAI() {
    const promptInput = document.getElementById('ai-prompt');
    const prompt = promptInput.value;
    
    if(!prompt) {
        alert('Silakan masukkan topik berita terlebih dahulu!');
        return;
    }

    const btn = document.getElementById('btn-ai');
    btn.innerHTML = '⏳ Berpikir...';
    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');

    // Menghubungi Route Laravel menggunakan Fetch
    fetch('{{ url("/admin/news/generate-ai") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Wajib untuk keamanan Laravel
        },
        body: JSON.stringify({ prompt: prompt })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Memasukkan hasil dari AI ke dalam inputan form
            document.getElementById('title-input').value = data.data.title;
            
            // Memasukkan konten ke Textarea
            document.getElementById('content-input').value = data.data.content;

            /* 
             * CATATAN PENTING:
             * Jika Anda menggunakan Text Editor seperti Trix atau CKEditor,
             * mengubah value textarea saja tidak cukup. Anda harus mengupdate instance editornya.
             * Contoh jika pakai Trix Editor:
             * document.querySelector("trix-editor").editor.loadHTML(data.data.content);
             */

            alert('Berita berhasil dibuat oleh AI! Silakan edit/sesuaikan sebelum disimpan.');
            promptInput.value = ''; // Kosongkan inputan AI
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan jaringan atau server.');
        console.error(error);
    })
    .finally(() => {
        // Kembalikan status tombol ke semula
        btn.innerHTML = 'Generate';
        btn.disabled = false;
        btn.classList.remove('opacity-70', 'cursor-not-allowed');
    });
}
</script>
</x-app-layout>
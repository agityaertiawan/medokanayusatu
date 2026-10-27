<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Berita</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Berita</label>
                        <input type="text" name="title" value="{{ old('title', $news->title) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Isi Berita</label>
                        <textarea name="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('content', $news->content) }}</textarea>
                    </div>

                    <!-- Preview Foto Lama + Upload Baru -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Cover Gambar Saat Ini</label>
                        @if($news->image)
                            <img src="{{ asset('storage/'.$news->image) }}" class="w-32 h-20 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500">
                        <p class="text-xs text-gray-400 mt-1">Pilih file baru jika ingin mengganti gambar.</p>
                    </div>

                    <!-- Preview PDF Lama + Upload Baru -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Lampiran PDF Saat Ini</label>
                        @if($news->pdf_attachment)
                            <p class="text-sm text-red-600 font-bold mb-2">📄 {{ basename($news->pdf_attachment) }}</p>
                        @endif
                        <input type="file" name="pdf_attachment" accept="application/pdf" class="block w-full text-sm text-gray-500">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
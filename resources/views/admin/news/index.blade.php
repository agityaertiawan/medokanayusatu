<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Berita & Kegiatan</h2>
            <a href="{{ route('admin.news.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
                + Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="p-4 font-bold text-gray-700">Cover</th>
                            <th class="p-4 font-bold text-gray-700">Judul Berita</th>
                            <th class="p-4 font-bold text-gray-700">Lampiran PDF</th>
                            <th class="p-4 font-bold text-gray-700">Tanggal</th>
                            <th class="p-4 font-bold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-16 h-12 object-cover rounded-md">
                                @else
                                    <span class="text-xs text-gray-400">Tanpa Foto</span>
                                @endif
                            </td>
                            <td class="p-4 font-semibold text-gray-800">{{ $item->title }}</td>
                            <td class="p-4">
                                @if($item->pdf_attachment)
                                    <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-bold">PDF Ada</span>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-500">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="p-4 flex space-x-2">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 px-3 py-1 rounded text-sm font-bold">Edit</a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">Belum ada data berita.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
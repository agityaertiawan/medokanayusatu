<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Murid Berprestasi</h2>
            <a href="{{ route('admin.achievements.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
                + Tambah Prestasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="p-4">Foto Siswa</th>
                            <th class="p-4">Nama Siswa</th>
                            <th class="p-4">Nama Lomba</th>
                            <th class="p-4">Tingkat</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($achievements as $item)
                        <tr class="border-b">
                            <td class="p-4">
                                <img src="{{ $item->photo ? asset('storage/'.$item->photo) : 'https://ui-avatars.com/api/?name='.urlencode($item->student_name) }}" class="w-12 h-12 rounded-full object-cover">
                            </td>
                            <td class="p-4 font-bold">{{ $item->student_name }}</td>
                            <td class="p-4 text-gray-700">{{ $item->competition_name }}</td>
                            <td class="p-4">
                                <span class="bg-yellow-100 text-yellow-800 font-bold px-3 py-1 rounded-full text-xs">
                                    {{ $item->level }}
                                </span>
                            </td>
                            <td class="p-4 flex space-x-2">
                                <a href="{{ route('admin.achievements.edit', $item->id) }}" class="bg-yellow-400 text-blue-900 px-3 py-1 rounded text-sm font-bold">Edit</a>
                                <form action="{{ route('admin.achievements.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data prestasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-6 text-center text-gray-500">Belum ada data prestasi siswa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
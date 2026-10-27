<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Guru & Karyawan</h2>
            <a href="{{ route('admin.staff.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
                + Tambah Staff
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
                            <th class="p-4">Foto</th>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">Jabatan</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $guru)
                        <tr class="border-b">
                            <td class="p-4">
                                <img src="{{ $guru->photo ? asset('storage/'.$guru->photo) : 'https://ui-avatars.com/api/?name='.urlencode($guru->name) }}" class="w-12 h-12 rounded-full object-cover">
                            </td>
                            <td class="p-4 font-bold">{{ $guru->name }}</td>
                            <td class="p-4 text-gray-600">{{ $guru->position }}</td>
                            <td class="p-4 flex space-x-2">
                                <a href="{{ route('admin.staff.edit', $guru->id) }}" class="bg-yellow-400 text-blue-900 px-3 py-1 rounded text-sm font-bold">Edit</a>
                                <form action="{{ route('admin.staff.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Hapus data guru ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-6 text-center text-gray-500">Belum ada data guru/staff.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
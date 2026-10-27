<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Murid Berprestasi</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('admin.achievements.update', $achievement->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" name="student_name" value="{{ old('student_name', $achievement->student_name) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Lomba</label>
                        <input type="text" name="competition_name" value="{{ old('competition_name', $achievement->competition_name) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tingkat Lomba</label>
                        <select name="level" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach(['Tingkat Kecamatan', 'Tingkat Kota', 'Tingkat Provinsi',  'Tingkat Nasional', 'Tingkat Internasional'] as $lvl)
                                <option value="{{ $lvl }}" {{ $achievement->level == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Foto Siswa Saat Ini</label>
                        @if($achievement->photo)
                            <img src="{{ asset('storage/'.$achievement->photo) }}" class="w-20 h-20 rounded-full object-cover mb-2">
                        @endif
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.achievements.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
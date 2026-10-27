<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Murid Berprestasi</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" name="student_name" class="mt-1 block w-full rounded-md border-gray-300" placeholder="Contoh: Anisa Putri" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Keterangan / Nama Lomba</label>
                        <input type="text" name="competition_name" class="mt-1 block w-full rounded-md border-gray-300" placeholder="Contoh: Juara 1 Olympiade Matematika" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tingkat Lomba</label>
                        <select name="level" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="Tingkat Kecamatan">Tingkat Kecamatan</option>
                            <option value="Tingkat Kota">Tingkat Kota</option>
                            <option value="Tingkat Provinsi">Tingkat Provinsi</option>
                            <option value="Tingkat Nasional">Tingkat Nasional</option>
                            <option value="Tingkat Internasional">Tingkat Internasional</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Foto Siswa / Dokumentasi</label>
                        <input type="file" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.achievements.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
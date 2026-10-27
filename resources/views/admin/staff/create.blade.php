<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Guru / Karyawan</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap (beserta Gelar)</label>
                        <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300" placeholder="Contoh: Budi Santoso, S.Pd." required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <input type="text" name="position" class="mt-1 block w-full rounded-md border-gray-300" placeholder="Contoh: Guru Kelas 5A / Kepala Sekolah" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                        <input type="file" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.staff.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaturan Profil Sekolah & Kepala Sekolah
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
                    <span class="mr-2">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:p-8">
                <form action="{{ route('admin.school_profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- SECTION 1: IDENTITAS SEKOLAH -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-bold text-blue-800 mb-4">🏫 Identitas & Kontak Sekolah</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                                <input type="text" name="school_name" value="{{ old('school_name', $profile->school_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Resmi Sekolah</label>
                                <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap Sekolah</label>
                                <textarea name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('address', $profile->address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: KEPALA SEKOLAH -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-bold text-blue-800 mb-4">👤 Data Kepala Sekolah</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Kepala Sekolah (beserta Gelar)</label>
                                <input type="text" name="headmaster_name" value="{{ old('headmaster_name', $profile->headmaster_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Foto Kepala Sekolah</label>
                                @if($profile->headmaster_photo)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/'.$profile->headmaster_photo) }}" class="w-20 h-20 rounded-full object-cover border-2 border-blue-500 shadow">
                                    </div>
                                @endif
                                <input type="file" name="headmaster_photo" accept="image/*" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md p-1">
                                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Kata Sambutan Kepala Sekolah</label>
                                <textarea name="headmaster_welcome" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('headmaster_welcome', $profile->headmaster_welcome) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: VISI, MISI, & SEJARAH -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-blue-800 mb-4">📜 Visi, Misi, & Sejarah Sekolah</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Visi Sekolah</label>
                                <textarea name="vision" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('vision', $profile->vision) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Misi Sekolah</label>
                                <textarea name="mission" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('mission', $profile->mission) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sejarah Singkat Sekolah</label>
                                <textarea name="history" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('history', $profile->history) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL SIMPAN -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition duration-200">
                            💾 Simpan Perubahan Profil
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
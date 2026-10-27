<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-red-700 leading-tight">
            {{ __('Pengaturan Akun Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Blok 1: Ubah Profil -->
            <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-2xl border-t-4 border-red-500">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Blok 2: Ubah Password -->
            <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-2xl border-t-4 border-yellow-400">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Blok 3: Hapus Akun -->
            <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-2xl border-t-4 border-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
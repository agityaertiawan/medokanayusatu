<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SDN Medokan Ayu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Animasi Latar Belakang Gelembung Bergerak */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Animasi Kotak Login Muncul dari Bawah */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        /* Animasi Kiri ke Kanan untuk Logo */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-slide-in-left {
            animation: slideInLeft 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-red-50 text-gray-800 font-sans antialiased min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Latar Belakang Gelembung Animasi -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-200 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-yellow-200 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-red-300 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Kontainer Utama Login -->
    <div class="relative z-10 w-full max-w-4xl flex flex-col md:flex-row bg-white rounded-3xl shadow-2xl overflow-hidden animate-fade-in-up mx-4">
        
        <!-- Bagian Kiri (Informasi/Logo) -->
        <div class="w-full md:w-5/12 bg-gradient-to-br from-red-600 to-red-800 p-10 flex flex-col justify-center items-center text-center text-white relative overflow-hidden">
            <!-- Ornamen Lingkaran di Bagian Kiri -->
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                <div class="absolute -top-10 -left-10 w-32 h-32 border-4 border-red-500 rounded-full opacity-50"></div>
                <div class="absolute bottom-10 -right-10 w-40 h-40 border-4 border-red-500 rounded-full opacity-50"></div>
            </div>

            <div class="relative z-10 animate-slide-in-left">
                <!-- Bisa diganti dengan Logo Sekolah Asli -->
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" alt="Logo Sekolah" class="w-24 h-24 mx-auto bg-white p-2 rounded-full shadow-lg mb-6 transform hover:rotate-12 transition duration-500">
                <h1 class="text-2xl font-extrabold mb-2 drop-shadow-md">SDN Medokan Ayu</h1>
                <p class="text-red-100 text-sm">Portal Manajemen Sekolah Terpadu</p>
                <div class="mt-8">
                    <a href="{{ route('home') }}" class="text-sm text-yellow-300 hover:text-white transition-colors flex items-center justify-center">
                        &larr; Kembali ke Beranda Publik
                    </a>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="w-full md:w-7/12 p-10 md:p-12">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang 👋</h2>
                <p class="text-gray-500 text-sm">Silakan masukkan kredensial Anda untuk mengakses dashboard admin.</p>
            </div>

            <!-- Pesan Error / Status Session -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Input Email -->
                <div class="relative group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 group-focus-within:text-red-600 transition-colors">✉️</span>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white transition-all duration-300 shadow-sm"
                            placeholder="admin@sdnmedokanayu1.sch.id">
                    </div>
                    @error('email')
                        <span class="text-red-500 text-xs font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="relative group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 group-focus-within:text-red-600 transition-colors">🔒</span>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white transition-all duration-300 shadow-sm"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <span class="text-red-500 text-xs font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2 transition duration-200">
                        <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    {{-- @if (Route::has('password.request'))
                        <a class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif --}}
                </div>

                <!-- Tombol Login -->
                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        🚀 Masuk ke Dashboard
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
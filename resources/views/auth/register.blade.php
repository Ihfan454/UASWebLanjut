<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Smart Campus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <div class="mx-auto w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Smart Campus</h2>
                <p class="mt-2 text-sm text-gray-600">Daftar Akun Baru</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 text-center">Buat Akun Baru</h3>

                @if($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <ul class="text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Kampus</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="nama@kampus.ac.id">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" name="password" type="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Minimal 8 karakter">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Ulangi password">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Daftar Sebagai</label>
                        <select id="role" name="role" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-500">syarat dan ketentuan</a>
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full gradient-bg text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition shadow-lg">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-blue-700">
                            Gunakan email kampus yang valid. Akun Admin akan diverifikasi terlebih dahulu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col md:flex-row min-h-screen">

<div class="w-full md:w-1/2 flex items-center justify-center bg-gray-100 p-6 md:p-12">
    <div class="w-full max-w-[400px]">

        <h1 class="text-3xl font-bold mb-2 text-center">BUAT AKUN BARU</h1>
        <p class="text-gray-500 mb-6 text-center">Silakan lengkapi data diri Anda untuk mendaftar.</p>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full p-3 rounded-lg border mt-1 focus:ring-2 focus:ring-orange-400 outline-none" placeholder="Masukkan email" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" class="w-full p-3 rounded-lg border mt-1 focus:ring-2 focus:ring-orange-400 outline-none" placeholder="Masukkan nama" required>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor</label>
                    <input type="text" name="phone" class="w-full p-3 rounded-lg border mt-1" placeholder="Masukkan nomor telepon Anda">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <input type="text" name="alamat" class="w-full p-3 rounded-lg border mt-1" placeholder="Masukan alamat lengkap Anda">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-3 rounded-lg border mt-1" placeholder="********" required>
            </div>
            
    <div class="mt-6">
        <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-50 transition-colors shadow-sm font-semibold">
         <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Masuk dengan Google
        </a>
    </div>

            <button type="submit" class="w-full text-white py-3 rounded-lg mt-4 font-semibold transition hover:bg-orange-600 shadow-md" style="background-color: #FF9E0C;">
                Daftar
            </button>

        </form>

        <p class="text-sm mt-6 text-center">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:underline">Masuk</a>
        </p>

    </div>
</div>

<div class="w-full hidden md:w-1/2 md:flex items-center justify-center text-white p-10" style="background-color: #FF9E0C;">
    <div>
        <h1 class="text-4xl font-bold mb-4">
            Buat Akun Anda!
        </h1>
        <p>
            Siap untuk perjalanan berikutnya? Buat akun Anda dan mulai <br> eksplorasi pilihan armada kami.
        </p>
    </div>
</div>

</body>
</html>
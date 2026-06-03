<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen md:flex-row">

    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-100 py-12 px-4">
        <div class="w-full max-w-sm">
            <h1 class="text-3xl font-bold mb-2 text-center">Konfirmasi Password</h1>
            <p class="text-gray-500 mb-6 text-center">Silakan masukkan password Anda untuk melanjutkan.</p>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full p-3 rounded-lg border border-gray-200 focus:border-orange-400 focus:ring-orange-100 focus:outline-none" placeholder="Masukkan password" />
                </div>

                <button type="submit" class="w-full py-3 rounded-lg text-white font-semibold transition hover:bg-orange-600" style="background-color: #FF9E0C;">Konfirmasi</button>
            </form>

            <p class="text-sm text-center text-gray-500 mt-5">
                Kembali ke
                <a href="{{ route('login') }}" class="text-orange-500 font-semibold">Login</a>
            </p>
        </div>
    </div>

    <div class="w-full hidden md:w-1/2 md:flex items-center justify-center text-white p-10" style="background-color: #FF9E0C;">
        <div class="max-w-md text-center">
            <h1 class="text-4xl font-bold mb-4">Akses Aman</h1>
            <p class="text-base leading-relaxed">
                Kami perlu memverifikasi password untuk memastikan keamanan data Anda sebelum lanjut ke halaman berikutnya.
            </p>
        </div>
    </div>

</body>
</html>

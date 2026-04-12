<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen md:flex-row">

    <!-- LEFT FORM -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-100 py-12 px-4">
        <div class="w-full max-w-sm">
            <h1 class="text-3xl font-bold mb-2 text-center">Lupa Password</h1>
            <p class="text-gray-500 mb-6 text-center">Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset password.</p>

            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full p-3 rounded-lg border border-gray-200 focus:border-orange-400 focus:ring-orange-100 focus:outline-none" placeholder="Masukkan email Anda" />
                </div>

                <button type="submit" class="w-full py-3 rounded-lg text-white font-semibold transition hover:bg-orange-600" style="background-color: #FF9E0C;">Kirim Link Reset</button>
            </form>

            <p class="text-sm text-center text-gray-500 mt-5">
                Ingat password Anda?
                <a href="{{ route('login') }}" class="text-orange-500 font-semibold">Kembali ke Login</a>
            </p>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full hidden md:w-1/2 md:flex items-center justify-center text-white p-10" style="background-color: #FF9E0C;">
        <div class="max-w-md text-center">
            <h1 class="text-4xl font-bold mb-4">Reset Password</h1>
            <p class="text-base leading-relaxed">
                Masukkan email Anda untuk menerima instruksi reset password. Setelah mendapatkan tautan, Anda bisa membuat password baru dan kembali menggunakan akun Anda.
            </p>
        </div>
    </div>

</body>
</html>

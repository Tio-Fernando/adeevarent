<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col md:flex-row min-h-screen">

<div class="w-full md:w-1/2 flex items-center justify-center bg-gray-100 p-6 md:p-12">
    <div class="w-full max-w-[400px]">

        <h1 class="text-3xl font-bold mb-2 text-center">WELCOME BACK</h1>
        <p class="text-gray-500 mb-6 text-center">Please enter your details to register.</p>
        
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
                <input type="email" name="email" class="w-full p-3 rounded-lg border mt-1 focus:ring-2 focus:ring-orange-400 outline-none" placeholder="Enter your email" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" class="w-full p-3 rounded-lg border mt-1 focus:ring-2 focus:ring-orange-400 outline-none" placeholder="Enter your name" required>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">No Telepon</label>
                    <input type="text" name="phone" class="w-full p-3 rounded-lg border mt-1" placeholder="Masukan No telepon">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" class="w-full p-3 rounded-lg border mt-1" placeholder="Masukan Alamat">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-3 rounded-lg border mt-1" placeholder="********" required>
            </div>

            <button type="submit" class="w-full text-white py-3 rounded-lg mt-4 font-semibold transition hover:bg-orange-600 shadow-md" style="background-color: #FF9E0C;">
                Sign Up
            </button>

        </form>

        <p class="text-sm mt-6 text-center">
            Already have an account?
            <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:underline">Sign in</a>
        </p>

    </div>
</div>

<div class="w-full hidden md:w-1/2 md:flex items-center justify-center text-white p-10" style="background-color: #FF9E0C;">
    <div>
        <h1 class="text-4xl font-bold mb-4">
            Selamat Datang Kembali Bos
        </h1>
        <p>
            Destinasi impian menanti. Masuk dan pilih teman perjalananmu.
        </p>
    </div>
</div>

</body>
</html>
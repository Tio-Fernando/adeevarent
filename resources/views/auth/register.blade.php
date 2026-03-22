<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen">

<!-- LEFT FORM -->
<div class="w-1/2 flex items-center justify-center bg-gray-100">
    <div class="w-[400px]">

        <h1 class="text-3xl font-bold mb-2 text-center">WELCOME BACK</h1>
        <p class="text-gray-500 mb-6 text-center">Welcome back! Please enter your details.</p>
        
        @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full p-3 rounded-lg border mt-1" placeholder="Enter your email">
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" class="w-full p-3 rounded-lg border mt-1" placeholder="Enter your name">
            </div>

            <!-- No Telepon -->
            <div class="mb-4">
                <label>No Telepon</label>
                <input type="text" name="phone" class="w-full p-3 rounded-lg border mt-1" placeholder="Masukan No telepon">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full p-3 rounded-lg border mt-1" placeholder="********">
            </div>

            <button class="w-full text-white py-3 rounded-lg mt-4" style="background-color: #FF9E0C;">
                Sign Up
            </button>

        </form>

        <p class="text-sm mt-4 text-center">
            I have already account?
            <a href="{{ route('login') }}" class="text-orange-500">Sign in</a>
        </p>

    </div>
</div>

<!-- RIGHT SIDE -->
<div class="w-1/2 flex items-center justify-center text-white p-10" style="background-color: #FF9E0C;">
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen">

<!-- LEFT FORM -->
<div class="w-1/2 flex items-center justify-center bg-gray-100">
    <div class="w-[400px]">

        <h1 class="text-3xl font-bold mb-2 text-center">WELCOME BACK</h1>
        <p class="text-gray-500 mb-6 text-center">Welcome back! Please enter your details.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full p-3 rounded-lg border mt-1" placeholder="Enter your email" required autofocus>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full p-3 rounded-lg border mt-1" placeholder="********" required>
            </div>

            <!-- Remember + Forgot -->
            <div class="flex justify-between items-center text-sm mb-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <a href="{{ route('password.request') }}" class="text-gray-500">
                    Forgot password
                </a>
            </div>

            <!-- Button -->
            <button class="w-full text-white py-3 rounded-lg hover:bg-orange-600 transition" style="background-color: #FF9E0C;">
                Sign in
            </button>

        </form>  

        <p class="text-sm mt-4 text-center">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-orange-500">
                Sign up for free!
            </a>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-400 via-indigo-500 to-pink-600 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition duration-500 hover:scale-105">
        <div class="flex justify-center">
            <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" alt="User Icon" class="w-16 h-16 mb-4">
        </div>
        <h2 class="text-3xl font-bold text-center text-gray-700 mb-4">Welcome Back! 👋</h2>
        <p class="text-gray-500 text-center mb-6">Silakan login untuk melanjutkan</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Email</label>
                <div class="relative">
                    <input type="email" name="email" class="w-full p-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="Masukkan email" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full p-3 pl-10 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="Masukkan password" required>
                    <button type="button" id="togglePassword" class="absolute right-3 top-3 text-gray-400 focus:outline-none">
                        🔍
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" class="mr-2">
                    Ingat saya
                </label>
                <a href="#" class="text-purple-500 font-semibold hover:underline">Lupa password?</a>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white p-3 rounded-lg font-semibold hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                Login 🚀
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-purple-500 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>
</html>

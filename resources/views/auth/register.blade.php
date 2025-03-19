<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-400 via-blue-500 to-purple-600 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition duration-500 hover:scale-105">
        <div class="flex justify-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Register Icon" class="w-16 h-16 mb-4">
        </div>
        <h2 class="text-3xl font-bold text-center text-gray-700 mb-4">Create Your Account</h2>
        <p class="text-gray-500 text-center mb-6">Isi form di bawah untuk mendaftar</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Nama</label>
                <div class="relative">
                    <input type="text" name="name" class="w-full p-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Masukkan nama lengkap" required>
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Email</label>
                <div class="relative">
                    <input type="email" name="email" class="w-full p-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Masukkan email" required>
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Password</label>
                <div class="relative">
                    <input type="password" name="password" class="w-full p-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Masukkan password" required>
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">Role</label>
                <div class="relative">
                    <select name="role" class="w-full p-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                        <option value="" disabled selected>Pilih role</option>
                        <option value="kasir">Kasir</option>
                        <option value="admin">Admin</option>
                        <option value="pemilik">Pemilik</option>
                    </select>
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-user-tag"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white p-3 rounded-lg font-semibold hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                Register 🚀
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-green-500 font-semibold hover:underline">Login</a>
        </p>
    </div>
</body>
</html>

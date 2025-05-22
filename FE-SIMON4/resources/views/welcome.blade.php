<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Aplikasi Saya!</h1>
        <p class="text-gray-600 mb-6">Ini adalah halaman utama aplikasi Anda.</p>
        <div class="space-x-4">
            @auth
                {{-- Jika user sudah login --}}
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200 ease-in-out">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    {{-- @csrf DIHAPUS SESUAI PERMINTAAN. SANGAT TIDAK AMAN! --}}
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200 ease-in-out">Logout</button>
                </form>
            @else
                {{-- Jika user belum login --}}
                <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200 ease-in-out">Login</a>
            @endauth
        </div>
    </div>
</body>
</html>
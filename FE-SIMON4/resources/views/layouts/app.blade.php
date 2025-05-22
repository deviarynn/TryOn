<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Monitoring Kehadiran')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6; /* Lighter gray background */
        }
        /* Custom CSS for sidebar transition */
        .sidebar {
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for sidebar */
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .content-area {
            transition: margin-left 0.3s ease-in-out;
        }
        .animate-fade-in {
            opacity: 0;
            transform: translateY(20px);
        }
        /* New custom styling for card hover effect */
        .card-hover-scale:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 overflow-x-hidden font-sans">

    <nav class="bg-blue-700 shadow-lg p-4 flex justify-between items-center fixed w-full z-20 top-0">
        <div class="flex items-center">
            <button id="sidebarToggle" class="text-white focus:outline-none mr-4 lg:hidden p-2 rounded-md hover:bg-blue-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="text-2xl font-semibold text-white tracking-wide">
                📊 Monitoring Kehadiran
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-blue-100 hidden md:block text-lg">Halo, <span class="font-medium">Administrator!</span></span>
            <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg font-medium shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                Logout
            </button>
        </div>
    </nav>

    <div class="flex pt-16"> {{-- pt-16 to account for fixed navbar height --}}

        <aside id="sidebar" class="sidebar w-64 bg-gray-800 text-white fixed h-screen p-6 z-10 lg:translate-x-0">
            <div class="text-2xl font-bold mb-8 text-center text-blue-400">Menu Utama</div>
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="{{ url('/') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out {{ Request::is('/') ? 'bg-blue-600 text-white shadow-inner' : 'text-gray-200' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('kelas.index') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out {{ Request::is('kelas*') ? 'bg-blue-600 text-white shadow-inner' : 'text-gray-200' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            <span class="font-medium">Manajemen Kelas</span>
                        </a>
                    </li>
                    {{-- Anda bisa menambahkan menu lain seperti Mahasiswa, Mata Kuliah, Jadwal, dll. di sini --}}
                    {{-- Contoh: --}}
                    {{-- <li class="mb-3">
                        <a href="{{ route('mahasiswa.index') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out {{ Request::is('mahasiswa*') ? 'bg-blue-600 text-white shadow-inner' : 'text-gray-200' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2V10a2 2 0 012-2h3.28a2 2 0 00.772-.188L11 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.293.707V17z"></path></svg>
                            <span class="font-medium">Data Mahasiswa</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('matakuliah.index') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out {{ Request::is('matakuliah*') ? 'bg-blue-600 text-white shadow-inner' : 'text-gray-200' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <span class="font-medium">Mata Kuliah</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('jadwal.index') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out {{ Request::is('jadwal*') ? 'bg-blue-600 text-white shadow-inner' : 'text-gray-200' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="font-medium">Jadwal Perkuliahan</span>
                        </a>
                    </li> --}}
                </ul>
            </nav>
        </aside>

        <main id="contentArea" class="content-area flex-1 ml-64 p-8">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('contentArea');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Function to control sidebar visibility
        const toggleSidebar = () => {
            sidebar.classList.toggle('sidebar-hidden');
            // Adjust content margin when sidebar is hidden/shown
            if (sidebar.classList.contains('sidebar-hidden')) {
                contentArea.classList.remove('ml-64');
                contentArea.classList.add('ml-0');
            } else {
                contentArea.classList.remove('ml-0');
                contentArea.classList.add('ml-64');
            }
        };

        // Event listener for sidebar toggle button
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Set initial sidebar status based on screen size
        const adjustSidebarOnLoad = () => {
            if (window.innerWidth < 1024) { // 1024px is Tailwind's 'lg' breakpoint
                sidebar.classList.add('sidebar-hidden');
                contentArea.classList.remove('ml-64');
                contentArea.classList.add('ml-0');
            } else {
                sidebar.classList.remove('sidebar-hidden');
                contentArea.classList.remove('ml-0');
                contentArea.classList.add('ml-64');
            }
        };

        // Call on page load
        adjustSidebarOnLoad();

        // Call on window resize
        window.addEventListener('resize', adjustSidebarOnLoad);

        // Basic animation for cards (you can use a library like AOS for more advanced ones)
        const cards = document.querySelectorAll('.animate-fade-in');
        cards.forEach((card, index) => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 150)); // Delay each card
        });
    </script>
</body>
</html>

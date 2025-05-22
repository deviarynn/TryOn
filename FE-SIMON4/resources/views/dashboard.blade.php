@extends('layouts.app')

@section('title', 'Dashboard Kehadiran')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4 flex items-center">
        <svg class="w-10 h-10 mr-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
        Overview Sistem Kehadiran
    </h1>
    <p class="text-gray-700 text-lg">Pantau dan kelola data kehadiran mahasiswa secara real-time. Dapatkan wawasan cepat tentang status kehadiran.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- Card untuk Total Mahasiswa --}}
    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white p-8 rounded-xl shadow-lg animate-fade-in delay-100 transform card-hover-scale relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 opacity-20">
            <svg class="w-32 h-32 text-blue-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2V10a2 2 0 012-2h3.28a2 2 0 00.772-.188L11 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.293.707V17z"></path></svg>
        </div>
        <h2 class="text-xl font-semibold mb-3">Total Mahasiswa</h2>
        <p class="text-5xl font-bold">200</p>
        <p class="text-blue-100 mt-3">Jumlah keseluruhan mahasiswa terdaftar.</p>
    </div>

    {{-- Card untuk Sesi Kehadiran Hari Ini --}}
    <div class="bg-gradient-to-br from-green-500 to-teal-600 text-white p-8 rounded-xl shadow-lg animate-fade-in delay-200 transform card-hover-scale relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 opacity-20">
            <svg class="w-32 h-32 text-green-200" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <h2 class="text-xl font-semibold mb-3">Sesi Hari Ini</h2>
        <p class="text-5xl font-bold">8</p>
        <p class="text-teal-100 mt-3">Sesi perkuliahan yang terjadwal hari ini.</p>
    </div>

    {{-- Card untuk Mahasiswa Hadir Hari Ini (Contoh Data) --}}
    <div class="bg-gradient-to-br from-purple-500 to-pink-600 text-white p-8 rounded-xl shadow-lg animate-fade-in delay-300 transform card-hover-scale relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 opacity-20">
            <svg class="w-32 h-32 text-purple-200" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.001 12.001 0 002 12c0 2.83 1.044 5.426 2.766 7.374L12 22.944l7.234-3.57C20.956 17.426 22 14.83 22 12c0-3.187-1.147-6.096-3.044-8.016z"></path></svg>
        </div>
        <h2 class="text-xl font-semibold mb-3">Hadir Hari Ini</h2>
        <p class="text-5xl font-bold">185</p>
        <p class="text-pink-100 mt-3">Mahasiswa yang tercatat hadir hari ini.</p>
    </div>

    {{-- Card untuk Rekapitulasi Cepat Absensi --}}
    <div class="bg-white p-8 rounded-xl shadow-lg animate-fade-in delay-400 col-span-1 md:col-span-3 card-hover-scale">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-7 h-7 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Rekap Kehadiran (Minggu Ini)
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                <span>Hadir:</span>
                <span class="font-bold text-green-600">95%</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                <span>Terlambat:</span>
                <span class="font-bold text-yellow-600">3%</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                <span>Izin:</span>
                <span class="font-bold text-blue-600">1.5%</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                <span>Alpha:</span>
                <span class="font-bold text-red-600">0.5%</span>
            </div>
        </div>
        <p class="text-gray-600 mt-4 text-sm">Persentase rata-rata kehadiran mahasiswa dalam seminggu terakhir.</p>
    </div>

    {{-- Card untuk Notifikasi Sistem (diadaptasi) --}}
    <div class="bg-white p-8 rounded-xl shadow-lg animate-fade-in delay-500 col-span-1 md:col-span-3 card-hover-scale">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-7 h-7 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            Notifikasi Sistem
        </h2>
        <ul class="list-none space-y-4 text-gray-700">
            <li class="flex items-start">
                <span class="text-orange-500 text-xl mr-3">&bull;</span>
                <div>
                    <strong class="font-medium">Update Sistem:</strong> Versi terbaru fitur laporan kehadiran telah dirilis. Periksa di menu Rekap Kehadiran.
                </div>
            </li>
            <li class="flex items-start">
                <span class="text-orange-500 text-xl mr-3">&bull;</span>
                <div>
                    <strong class="font-medium">Data Kehadiran Hari Ini:</strong> Pastikan semua data kehadiran hari ini telah tersinkronisasi.
                </div>
            </li>
            <li class="flex items-start">
                <span class="text-orange-500 text-xl mr-3">&bull;</span>
                <div>
                    <strong class="font-medium">Batas Pengisian Kehadiran:</strong> Pengisian kehadiran untuk sesi pagi berakhir pukul 12:00 WIB.
                </div>
            </li>
        </ul>
    </div>

</div>
@endsection

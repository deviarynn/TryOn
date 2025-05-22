@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Kelas</h1>
        <div class="flex space-x-2">
            <a href="{{ route('kelas.create') }}" class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium transition duration-200 ease-in-out transform hover:scale-105">
                Tambah Kelas Baru
            </a>
            <input type="text" id="searchInput" placeholder="Cari kelas..." class="border p-2 rounded">

            <script>
              document.getElementById("searchInput").addEventListener("keyup", function () {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll("#kelasTable tbody tr");
            
                rows.forEach(row => {
                  const rowText = row.innerText.toLowerCase();
                  row.style.display = rowText.includes(searchTerm) ? "" : "none";
                });
              });
            </script>
        </div>
    </div>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Pesan Error dari Session (misal dari redirect()->with('error')) --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Pesan Error dari Validasi Laravel (objek $errors bawaan) --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan Validasi!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    {{-- Pesan Error dari API (array $apiErrors yang diteruskan dari controller) --}}
    @elseif (!empty($apiErrors) && is_array($apiErrors))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan API!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($apiErrors as $key => $error)
                    <li>{{ $key }}: {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto">
        @if (empty($kelas))
            <p class="text-gray-600 text-center py-8">Tidak ada data kelas yang tersedia. Silakan tambahkan kelas baru.</p>
        @else
            <table id="kelasTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead>
                    <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Kode Kelas</th>
                        <th class="py-3 px-6 text-left">Nama Kelas</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($kelas as $kls)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $kls['kode_kelas'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $kls['nama_kelas'] }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    {{-- Link untuk melihat detail (tanda mata) --}}
                                    <a href="{{ route('kelas.show', $kls['kode_kelas']) }}" class="text-blue-500 hover:text-blue-700 transition duration-200 ease-in-out" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>

                                    <a href="{{ route('kelas.edit', $kls['kode_kelas']) }}" class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $kls['kode_kelas']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200 ease-in-out" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    {{-- Tombol Cetak Per Baris Data --}}
                                    <a href="{{ route('kelas.cetak', $kls['kode_kelas']) }}" target="_blank" class="text-green-500 hover:text-green-700 transition duration-200 ease-in-out" title="Cetak Data Ini">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12h.01"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- Script JavaScript lama untuk cetak tabel dihapus --}}
@endsection

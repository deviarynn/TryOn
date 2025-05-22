@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Kelas: {{ $kelas['nama_kelas'] ?? '' }}</h1>

    {{-- Pesan Error dari Validasi atau API --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pastikan $kelas ada dan bukan null sebelum mengakses elemennya --}}
    @if (isset($kelas))
        <form action="{{ route('kelas.update', $kelas['kode_kelas']) }}" method="POST" class="space-y-4">
            @csrf {{-- Token CSRF untuk keamanan Laravel --}}
            @method('PUT') {{-- Menggunakan method PUT untuk update --}}

            <div>
                <label for="kode_kelas" class="block text-sm font-medium text-gray-700">Kode Kelas</label>
                <input type="text" id="kode_kelas" value="{{ $kelas['kode_kelas'] }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed sm:text-sm"
                       readonly disabled> {{-- Kode kelas biasanya tidak bisa diubah --}}
            </div>

            <div>
                <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas['nama_kelas']) }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       required maxlength="40">
                @error('nama_kelas')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('kelas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition duration-200 ease-in-out">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 ease-in-out transform hover:scale-105">
                    Update Kelas
                </button>
            </div>
        </form>
    @else
        <p class="text-red-500">Data kelas tidak ditemukan.</p>
    @endif
</div>
@endsection

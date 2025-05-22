@extends('layouts.app')

@section('title', 'Tambah Kelas Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kelas Baru</h1>

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

    <form action="{{ route('kelas.store') }}" method="POST" class="space-y-4">
        @csrf {{-- Token CSRF untuk keamanan Laravel --}}

        <div>
            <label for="kode_kelas" class="block text-sm font-medium text-gray-700">Kode Kelas</label>
            <input type="text" name="kode_kelas" id="kode_kelas" value="{{ old('kode_kelas') }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   required maxlength="6">
            @error('kode_kelas')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
            <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}"
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
                Simpan Kelas
            </button>
        </div>
    </form>
</div>
@endsection

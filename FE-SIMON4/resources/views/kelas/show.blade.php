@extends('layouts.app')

@section('title', 'Detail kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Kelas</h1>
        <div class="flex space-x-2"> {{-- Sembunyikan tombol ini saat dicetak --}}
            <a href="{{ route('kelas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
        </div>
    </div>

    @if (empty($kelas))
        <p class="text-red-600">Data kelas tidak ditemukan.</p>
    @else
        {{-- Konten yang akan dicetak --}}
        <div id="detailToPrint">
            <h2 class="text-xl font-bold text-gray-800 mb-4 print:block hidden">Detail kelas</h2> {{-- Judul untuk cetak --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 font-semibold">Kode Kelas:</p>
                    <p class="text-gray-800 text-lg">{{ $kelas['kode_kelas'] }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Nama kelas:</p>
                    <p class="text-gray-800 text-lg">{{ $kelas['nama_kelas'] }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex space-x-4 print:hidden"> {{-- Sembunyikan tombol ini saat dicetak --}}
            <a href="{{ route('kelas.edit', $kelas['kode_kelas']) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Edit</a>
            <form action="{{ route('kelas.destroy', $kelas['kode_kelas']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Hapus</button>
            </form>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const printButton = document.getElementById('printDetail');

        if (printButton) {
            printButton.addEventListener('click', function() {
                const detailToPrint = document.getElementById('detailToPrint');

                if (detailToPrint) {
                    const printWindow = window.open('', '', 'height=600,width=800');
                    printWindow.document.write('<html><head><title>Cetak Detail kelas</title>');
                    printWindow.document.write('<link href="https://cdn.jsdelivr.net/kode_kelas/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">');
                    printWindow.document.write('<style>');
                    printWindow.document.write('@media print {');
                    printWindow.document.write('  body { font-family: sans-serif; margin: 20px; }');
                    printWindow.document.write('  .print\\:hidden { display: none !important; }');
                    printWindow.document.write('  .print\\:block { display: block !important; }'); // Tampilkan judul cetak
                    printWindow.document.write('}');
                    printWindow.document.write('</style>');
                    printWindow.document.write('</head><body>');
                    printWindow.document.body.appendChild(detailToPrint.cloneNode(true)); // Kloning konten detail
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                } else {
                    console.error('Elemen dengan ID "detailToPrint" tidak ditemukan.');
                }
            });
        }
    });
</script>
@endsection

# SEFRUIT TUTORIAL DARI SAYA

## Clone repository backend
https://github.com/MuhammadAbiAM/BE-Jadwal-Skripsi <br>
https://github.com/NalindraDT/Simon-kehadiran

## Donwload DB
Buka file yang .sql <br>
Salin semua query dan masukan ke sql database PhpMyAdmin <br>
https://github.com/mayangm09/DBE-SI-Penjadwalan-Skripsi.git <br>
https://github.com/JiRizkyCahyusna/DBE_Simon

### Ganti isi .env di laravel kita
```
DB_CONNECTION=mysql
DB_DATABASE=simon_kehadiran
SESSION_DRIVER=file
```

### Buatlah dashboard
### Buat folder layouts/app di view
### Buat folder mahasiswa, kelas/lainnya di view
Masing2 folder itu dibuat create, index, update, show

### Routes/web.php
```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('kelas', KelasController::class);
```
### Download DOM PDF untuk keperluan cetak
```bash
composer require barryvdh/laravel-dompdf 
```
1. Buat view cetak di folder mahasiswa/dosen/kelas/dll
```php
<!DOCTYPE html>
<html>
<head>
    <title>Detail Kelas {{ $unduhKelas->kode_kelas ?? 'N/A' }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', sans-serif;
            margin: 40px;
            color: #333;
            line-height: 1.6;
        }
        h1 {
            color: #2c3e50;
            font-size: 28px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Menghilangkan spasi antar sel */
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 12px 15px; /* Padding di dalam sel */
            border: 1px solid #ddd; /* Border tipis untuk sel */
            text-align: left;
            vertical-align: top;
        }
        table th {
            background-color: #f8f8f8; /* Warna latar belakang untuk header */
            color: #555;
            font-weight: 600;
            width: 30%; /* Berikan lebar tetap untuk kolom label */
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9; /* Warna latar belakang bergantian untuk baris */
        }
        table tr:hover {
            background-color: #f1f1f1; /* Efek hover (mungkin tidak terlalu terlihat di PDF, tapi baik untuk kebiasaan) */
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Data Kelas</h1>

        <table>
            <tbody>
                <tr>
                    <th>Kode Kelas</th>
                    <td>{{ $unduhKelas->kode_kelas ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Nama Kelas</th>
                    <td>{{ $unduhKelas->nama_kelas ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Dokumen ini dihasilkan secara otomatis oleh Sistem Informasi Kehadiran.</p>
            <p>&copy; {{ date('Y') }} Aplikasi Anda</p>
        </div>
    </div>
</body>
</html>
```
2. Ubah bagian model Kelas
```php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Pastikan ini nama tabel kelas Anda
    protected $primaryKey = 'kode_kelas'; // Atau 'kode_kelas' jika itu primary key Anda
    public $incrementing = false; // Set false jika primaryKey non-incrementing
    protected $keyType = 'string'; // Atau 'string' jika kode_kelas string

    protected $fillable = [
        // Daftar kolom yang bisa diisi secara massal
        'kode_kelas',
        'nama_kelas',
    ];
}
```
Bebas mana aja sesuaikan
3. Routes/web.php
```php
Route::get('/kelas/{kode_kelas}/unduh', [KelasController::class, 'unduhKelas'])->name('kelas.cetak');
```
4. KelasController
tambahkan ini diatas
```php
use App\Models\User; // Pastikan model User ada
use App\Models\Kelas; // Impor model Kelas Anda, sesuaikan jika nama modelnya berbeda
use Illuminate\Support\Facades\Log; // Untuk logging error
```
Lalu dilanjut
```php
 public function unduhKelas($kode_kelas)
    {
        // 1. Ambil detail kelas dari database lokal Anda berdasarkan $kode_kelas
        $unduhKelas = Kelas::where('kode_kelas', $kode_kelas)->first();

        // Jika kelas tidak ditemukan, kembalikan error
        if (!$unduhKelas) {
            return back()->with('error', 'Kelas dengan kode ' . $kode_kelas . ' tidak ditemukan.');
        }

        // 2. Buat view untuk PDF. Contoh: resources/views/kelas/cetak.blade.php
        $pdf = PDF::loadView('kelas.cetak', compact('unduhKelas'));

        // 3. Kembalikan PDF sebagai unduhan
        return $pdf->download('kelas.cetak_' . $kode_kelas . '.pdf');
    }
```







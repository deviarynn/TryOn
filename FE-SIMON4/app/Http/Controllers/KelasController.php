<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User; // Pastikan model User ada
use App\Models\Kelas; // Impor model Kelas Anda, sesuaikan jika nama modelnya berbeda
use Illuminate\Support\Facades\Log; // Untuk logging error

use Barryvdh\DomPDF\Facade\Pdf; // tambahkan di atas

class KelasController extends Controller
{
    protected $apiUrl = 'http://localhost:8000/api'; // Contoh: ganti ini dengan API URL Anda
    protected $endpoint = 'http://localhost:8080/kelas';

    public function index()
    {
        $kelas = []; // Initialize as an empty array
        $apiErrors = []; // Initialize for API errors

        try {
            $response = Http::get($this->endpoint);

            if ($response->successful()) {
                $kelas = $response->json(); // Get JSON data from the response
                // Assuming the API returns a direct array of class objects, e.g., [...]
                // If your API returns {'data': [...]}, you might need: $kelas = $response->json()['data'];
            } else {
                // Handle error if API does not return a successful status
                $errorMessage = $response->json()['message'] ?? 'Failed to retrieve class data from API.';
                $apiErrors['api_error'] = $errorMessage;
            }
        } catch (\Exception $e) {
                // Handle exception for connection issues
            $apiErrors['connection_error'] = 'Could not connect to the class API: ' . $e->getMessage();
        }

        // Pass the normalized class data and API errors to the view
        return view('kelas.index', compact('kelas', 'apiErrors'));
    }

    /**
     * Show the form for creating a new class.
     * This method is required by Route::resource for the GET /kelas/create route.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('kelas.create');
    }

    // public function store(Request $request)
    // {
    //     // KEMBALIKAN VALIDASI LARAVEL
    //     $request->validate([
    //         'kode_kelas' => 'required|string|max:6',
    //         'nama_kelas' => 'required|string|max:40',
    //     ]);

    //     try {
    //         $response = Http::asForm()->post($this->endpoint, $request->all());

    //         if ($response->successful()) {
    //             return redirect()->route('kelas.index')->with('success', 'Class data successfully added!');
    //         } else {
    //             // Perbaiki penanganan pesan error dari API CodeIgniter
    //             $apiResponse = $response->json();
    //             $errorMessage = 'Failed to add class data.';

    //             if (isset($apiResponse['messages'])) {
    //                 // Jika ada array 'messages' (misal dari fail($this->model->errors()))
    //                 if (is_array($apiResponse['messages'])) {
    //                     $errorMessage = implode(', ', array_values($apiResponse['messages']));
    //                 } else {
    //                     $errorMessage = $apiResponse['messages'];
    //                 }
    //             } elseif (isset($apiResponse['message'])) {
    //                 // Jika ada kunci 'message'
    //                 $errorMessage = $apiResponse['message'];
    //             }

    //             return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withInput()->withErrors(['connection_error' => 'Could not connect to API: ' . $e->getMessage()]);
    //     }
    // }

    public function store(Request $request)
    {
        // KEMBALIKAN VALIDASI LARAVEL
        $request->validate([
            'kode_kelas' => 'required|string|max:6',
            'nama_kelas' => 'required|string|max:40',
        ]);

        try {
            // PENTING: Hapus asForm() karena CI backend sekarang menerima JSON
            $response = Http::post($this->endpoint, $request->all());

            if ($response->successful()) {
                return redirect()->route('kelas.index')->with('success', 'Class data successfully added!');
            } else {
                // Perbaiki penanganan pesan error dari API CodeIgniter
                $apiResponse = $response->json();
                $errorMessage = 'Failed to add class data.';

                if (isset($apiResponse['messages'])) {
                    // Jika ada array 'messages' (misal dari fail($this->model->errors()))
                    if (is_array($apiResponse['messages'])) {
                        $errorMessage = implode(', ', array_values($apiResponse['messages']));
                    } else {
                        $errorMessage = $apiResponse['messages'];
                    }
                } elseif (isset($apiResponse['message'])) {
                    // Jika ada kunci 'message'
                    $errorMessage = $apiResponse['message'];
                }

                return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['connection_error' => 'Could not connect to API: ' . $e->getMessage()]);
        }
    }


    public function show($id)
    {
        try {
            $kelas = Http::get("{$this->endpoint}/{$id}")->json();
            return view('kelas.show', compact('kelas'));
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Could not connect to API: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $kelas = Http::get("{$this->endpoint}/{$id}")->json();
            return view('kelas.edit', compact('kelas'));
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Could not connect to API: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:40',
        ]);

        try {
            $response = Http::put("{$this->endpoint}/{$id}", $request->except('kode_kelas'));

            if ($response->successful()) {
                return redirect()->route('kelas.index')->with('success', 'Class data successfully updated!');
            } else {
                $apiResponse = $response->json();
                $errorMessage = 'Failed to update class data.';

                if (isset($apiResponse['messages'])) {
                    if (is_array($apiResponse['messages'])) {
                        $errorMessage = implode(', ', array_values($apiResponse['messages']));
                    } else {
                        $errorMessage = $apiResponse['messages'];
                    }
                } elseif (isset($apiResponse['message'])) {
                    $errorMessage = $apiResponse['message'];
                }
                return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['connection_error' => 'Could not connect to API: ' . $e->getMessage()]);
        }
    }

     public function unduhKelas($kode_kelas)
    {
        // 1. Ambil detail kelas dari database lokal Anda berdasarkan $kode_kelas
        $unduhKelas = Kelas::where('kode_kelas', $kode_kelas)->first();

        // Jika kelas tidak ditemukan, kembalikan error
        if (!$unduhKelas) {
            return back()->with('error', 'Kelas dengan kode ' . $kode_kelas . ' tidak ditemukan.');
        }

        // 2. Buat view untuk PDF. Contoh: resources/views/pdfs/detail_kelas.blade.php
        $pdf = PDF::loadView('kelas.cetak', compact('unduhKelas'));

        // 3. Kembalikan PDF sebagai unduhan
        return $pdf->download('kelas.cetak_' . $kode_kelas . '.pdf');
    }


    public function destroy($id)
    {
        try {
            $response = Http::delete("{$this->endpoint}/{$id}");

            if ($response->successful()) {
                return redirect()->route('kelas.index')->with('success', 'Class data successfully deleted!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to delete class data.';
                return redirect()->route('kelas.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Could not connect to API: ' . $e->getMessage());
        }
    }
}

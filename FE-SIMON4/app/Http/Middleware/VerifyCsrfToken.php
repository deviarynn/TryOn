<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/login',  // Mengecualikan rute POST untuk login
        '/logout', // Mengecualikan rute POST untuk logout
        // Tambahkan rute lain yang memerlukan pengecualian di sini jika ada
    ];
}
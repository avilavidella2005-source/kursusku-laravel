<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $siteName = 'KursusKu';
        
        // Data dummy untuk tabel katalog
        $featured = [
            ['code' => 'WEB-01', 'name' => 'Web Dasar', 'fee' => 200000, 'start_date' => '2026-09-21', 'quota' => 30, 'registered' => 12],
            ['code' => 'PHP-01', 'name' => 'PHP Dasar', 'fee' => 250000, 'start_date' => '2026-09-22', 'quota' => 30, 'registered' => 18],
            ['code' => 'PHP-02', 'name' => 'PHP Lanjutan', 'fee' => 300000, 'start_date' => '2026-09-24', 'quota' => 25, 'registered' => 24],
            ['code' => 'LAR-01', 'name' => 'Laravel Fundamental', 'fee' => 350000, 'start_date' => '2026-09-28', 'quota' => 25, 'registered' => 25],
            ['code' => 'DB-01', 'name' => 'MySQL Dasar', 'fee' => 275000, 'start_date' => '2026-10-01', 'quota' => 20, 'registered' => 0],
            ['code' => 'UI-01', 'name' => 'UI Web Dasar', 'fee' => 225000, 'start_date' => '2026-10-05', 'quota' => 35, 'registered' => 9],
        ];

        return view('home', compact('siteName', 'featured'));
    }
}
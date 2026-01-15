<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function show()
    {
        // Nanti di sini kita tarik data dari database
        // Untuk sekarang kita tampilkan view saja
        return view('detail');
    }

    public function index()
{
    // Mengembalikan view listing
    return view('jelajah');
}
}
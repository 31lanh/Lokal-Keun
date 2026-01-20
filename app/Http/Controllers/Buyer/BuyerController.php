<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        // Tampilkan halaman welcome (landing page)
        return app(PublicController::class)->welcome();
    }
}

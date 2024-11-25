<?php

namespace App\Http\Controllers;

use App\Models\Kosan;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil kosan dengan relasi photos
        $kosans = Kosan::with('photos')->take(3)->get(); // Batasi hanya 3 data
        return view('welcome', compact('kosans'));
    }
}



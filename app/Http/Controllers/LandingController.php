<?php
namespace App\Http\Controllers;

use App\Models\Jurusan;

class LandingController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::where('is_active', true)
                           ->orderBy('nama_jurusan')
                           ->get();

        return view('landingpage.home', compact('jurusans'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanAlat;

class AdminController extends Controller
{
    public function index()
    {
        $totalPinjam = PeminjamanAlat::count();
        $totalKembali = PeminjamanAlat::where('status','dikembalikan')->count();
        $totalSedang = PeminjamanAlat::where('status','dipinjam')->count();

        return view('admin.dashboard', compact('totalPinjam','totalKembali','totalSedang'));
    }
}

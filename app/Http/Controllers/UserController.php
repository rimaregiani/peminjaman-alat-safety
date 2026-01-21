<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanAlat; 

class UserController extends Controller
{
    public function index()
    {
        $totalPinjam = PeminjamanAlat::where('user_id', auth()->id())->count();
        $totalKembali = PeminjamanAlat::where('user_id', auth()->id())
            ->where('status', 'dikembalikan')->count();
        $totalSedang = PeminjamanAlat::where('user_id', auth()->id())
            ->where('status', 'dipinjam')->count();

        return view('user.dashboard', compact('totalPinjam','totalKembali','totalSedang'));
    }

}

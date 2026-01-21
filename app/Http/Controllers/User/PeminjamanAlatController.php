<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlat;
use App\Models\AlatSafety;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanAlatController extends Controller
{
    public function index()
    {
        $pinjam = PeminjamanAlat::with('alat')->where('user_id', auth()->id())->get();
        return view('user.peminjaman.index', compact('pinjam'));
    }

    public function create()
    {
        $alat = AlatSafety::all();
        return view('user.peminjaman.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat_safety,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $alat = AlatSafety::find($request->alat_id);

        // Hitung stok tersedia
        $dipinjam = PeminjamanAlat::where('alat_id',$alat->id)
            ->whereIn('status',['pending','approved'])
            ->sum('jumlah');

        $stok_tersedia = $alat->stok - $dipinjam;

        if($request->jumlah > $stok_tersedia){
            // Kembalikan error khusus
            return redirect()->back()->with('stock_error', 'Stok tidak cukup, tersedia: '.$stok_tersedia)->withInput();
        }

        PeminjamanAlat::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()->route('user.peminjaman.index')->with('success','Pengajuan berhasil dibuat.');
    }

    public function generatePdf(PeminjamanAlat $peminjaman)
    {
        // Cek user hanya bisa lihat PDF miliknya sendiri
        if($peminjaman->user_id != auth()->id() || $peminjaman->status != 'approved'){
            abort(403, 'Anda tidak bisa mengakses PDF ini');
        }

        $pdf = Pdf::loadView('user.peminjaman.pdf', compact('peminjaman'));
        return $pdf->stream('bukti_peminjaman_'.$peminjaman->id.'.pdf');
    }
}

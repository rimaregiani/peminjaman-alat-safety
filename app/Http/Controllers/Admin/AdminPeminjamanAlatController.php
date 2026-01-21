<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlat;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminPeminjamanAlatController extends Controller
{
    public function index()
    {
        $pinjam = PeminjamanAlat::with(['alat','user'])->get();
        return view('admin.peminjaman.index', compact('pinjam'));
    }

    public function approve(PeminjamanAlat $peminjaman)
    {
        $peminjaman->status = 'approved';
        $peminjaman->tgl_pinjam = now();
        $peminjaman->save();

        return back()->with('success','Pengajuan disetujui.');
    }

    public function reject(PeminjamanAlat $peminjaman)
    {
        $peminjaman->status = 'rejected';
        $peminjaman->save();

        return back()->with('success','Pengajuan ditolak.');
    }

    public function generatePdf(PeminjamanAlat $peminjaman)
    {
        $pdf = Pdf::loadView('admin.peminjaman.pdf', compact('peminjaman'));
        return $pdf->stream('bukti_peminjaman_'.$peminjaman->id.'.pdf');
    }

    public function returnForm(PeminjamanAlat $peminjaman)
    {
        return view('admin.peminjaman.return', compact('peminjaman'));
    }

    public function returnStore(Request $request, PeminjamanAlat $peminjaman)
    {
        $request->validate([
            'foto_serah_terima' => 'required|image|max:2048'
        ]);

        $file = $request->file('foto_serah_terima');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/peminjaman'), $filename);

        $peminjaman->foto_serah_terima = $filename;
        $peminjaman->status = 'dikembalikan';
        $peminjaman->tgl_kembali = now();
        $peminjaman->save();

        return redirect()->route('admin.peminjaman.index')->with('success','Pengembalian berhasil.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlatSafety;
use App\Models\Category;

class AlatSafetyController extends Controller
{
    public function index()
    {
        $alat = AlatSafety::with('category')->get();
        return view('admin.alat_safety.index', compact('alat'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.alat_safety.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'lokasi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Auto-generate kode_alat
        $last = AlatSafety::latest()->first();
        $number = $last ? (int) substr($last->kode_alat,3)+1 : 1;
        $kode = 'AL-' . str_pad($number,3,'0',STR_PAD_LEFT);

        // Upload foto
        $filename = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/alat_safety'), $filename);
        }

        AlatSafety::create([
            'kode_alat' => $kode,
            'nama_alat' => $request->nama_alat,
            'category_id' => $request->category_id,
            'stok' => $request->stok,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $filename,
        ]);

        return redirect()->route('admin.alat_safety.index')->with('success','Alat berhasil ditambahkan.');
    }

    public function edit(AlatSafety $alat_safety)
    {
        $categories = Category::all();
        return view('admin.alat_safety.edit', compact('alat_safety','categories'));
    }

    public function update(Request $request, AlatSafety $alat_safety)
    {
        $request->validate([
            'nama_alat' => 'required',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'lokasi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload foto baru
        if($request->hasFile('foto')){
            if($alat_safety->foto && file_exists(public_path('uploads/alat_safety/'.$alat_safety->foto))){
                unlink(public_path('uploads/alat_safety/'.$alat_safety->foto));
            }
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/alat_safety'), $filename);
            $alat_safety->foto = $filename;
        }

        $alat_safety->update($request->only('nama_alat','category_id','stok','lokasi','keterangan','foto'));

        return redirect()->route('admin.alat_safety.index')->with('success','Alat berhasil diupdate.');
    }

    public function destroy(AlatSafety $alat_safety)
    {
        if($alat_safety->foto && file_exists(public_path('uploads/alat_safety/'.$alat_safety->foto))){
            unlink(public_path('uploads/alat_safety/'.$alat_safety->foto));
        }
        $alat_safety->delete();
        return redirect()->route('admin.alat_safety.index')->with('success','Alat berhasil dihapus.');
    }
}

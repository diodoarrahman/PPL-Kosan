<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data kosan dengan query builder
        $kosans = Kosan::query();

        // Filter berdasarkan search (nama atau alamat kosan)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $kosans->where(function ($query) use ($searchTerm) {
                $query->where('nama_kosan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('alamat_kosan', 'like', '%' . $searchTerm . '%');
            });
        }

        // Sort berdasarkan harga jika ada parameter 'sort'
        if ($request->has('sort')) {
            $sortDirection = $request->sort == 'asc' ? 'asc' : 'desc';
            $kosans->orderBy('harga_kosan', $sortDirection);
        }

        // Ambil data kosan setelah filter dan sorting
        $kosans = $kosans->get();

        // Kirim data kosan ke view
        return view('mainpage', compact('kosans'));
    }

    public function manage()
    {
        // Cek apakah pengguna yang sedang login adalah admin
        if (auth()->user()->role === 'admin') {
            // Jika admin, ambil semua kosan
            $kosans = Kosan::all();
        } else {
            // Jika bukan admin (misalnya owner), hanya ambil kosan yang dimiliki oleh pengguna yang sedang login
            $kosans = auth()->user()->kosans; // Relasi antara User dan Kosan
        }

        // Kirim data kosan ke view
        return view('kos.manage', compact('kosans'));
    }


    public function show($id)
    {
        $kosan = Kosan::findOrFail($id);
        return view('kos.show', compact('kosan'));
    }

    public function create()
    {
        return view('kos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kosan' => 'required|string|max:255',
            'alamat_kosan' => 'required|string|max:255',
            'harga_kosan' => 'required|numeric',
            'kamar_tersedia' => 'required|integer',
            'jenis_kosan' => 'required|string',
            'deskripsi_kosan' => 'required|string',
            'no_handphone' => 'nullable|string|max:15',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $kosan = Kosan::create($request->only([
            'nama_kosan',
            'alamat_kosan',
            'harga_kosan',
            'kamar_tersedia',
            'jenis_kosan',
            'deskripsi_kosan',
            'no_handphone',
            'latitude', // Menyimpan latitude
            'longitude', // Menyimpan longitude
        ]) + ['user_id' => Auth::id()]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $kosan->photos()->create(['photo_url' => $path]);
            }
        }

        return redirect()->route('kosan.manage')->with('success', 'Kosan berhasil ditambahkan beserta fotonya.');
    }


    public function edit($id)
    {
        $kosan = Kosan::findOrFail($id);
        return view('kos.edit', compact('kosan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kosan' => 'required|string|max:255',
            'alamat_kosan' => 'required|string|max:255',
            'harga_kosan' => 'required|numeric',
            'kamar_tersedia' => 'required|integer',
            'jenis_kosan' => 'required|string',
            'deskripsi_kosan' => 'required|string',
            'no_handphone' => 'nullable|string|max:15',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $kosan = Kosan::findOrFail($id);
        $kosan->update($request->only([
            'nama_kosan',
            'alamat_kosan',
            'harga_kosan',
            'kamar_tersedia',
            'jenis_kosan',
            'deskripsi_kosan',
            'no_handphone',
            'latitude', // Update latitude
            'longitude', // Update longitude
        ]));

        if ($request->hasFile('photos')) {
            // Menghapus foto lama
            foreach ($kosan->photos as $photo) {
                Storage::disk('public')->delete($photo->photo_url);
                $photo->delete();
            }

            // Menyimpan foto baru
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $kosan->photos()->create(['photo_url' => $path]);
            }
        }

        return redirect()->route('kosan.manage')->with('success', 'Kosan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $kosan = Kosan::findOrFail($id);

        // Hapus foto yang terasosiasi
        foreach ($kosan->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_url);
            $photo->delete();
        }

        $kosan->delete();

        return redirect()->route('kosan.manage')->with('success', 'Kosan beserta fotonya berhasil dihapus.');
    }
}

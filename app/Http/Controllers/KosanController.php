<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class KosanController extends Controller
{
    public function index()
    {
        $kosans = Kosan::all();
        return view('mainpage', compact('kosans'));
    }
    public function manage()
    {
        // Ambil kosan yang dimiliki oleh pengguna yang sedang login
        $kosans = auth()->user()->kosans; // Relasi antara User dan Kosan

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
        ]);

        $kosan = Kosan::create($request->only(['nama_kosan', 'alamat_kosan', 'harga_kosan', 'kamar_tersedia', 'jenis_kosan', 'deskripsi_kosan', 'no_handphone']) + ['user_id' => Auth::id()]);

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
        ]);

        $kosan = Kosan::findOrFail($id);
        $kosan->update($request->only(['nama_kosan', 'alamat_kosan', 'harga_kosan', 'kamar_tersedia', 'jenis_kosan', 'deskripsi_kosan', 'no_handphone']));

        if ($request->hasFile('photos')) {
            foreach ($kosan->photos as $photo) {
                Storage::disk('public')->delete($photo->photo_url);
                $photo->delete();
            }

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

        foreach ($kosan->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_url);
            $photo->delete();
        }

        $kosan->delete();

        return redirect()->route('kosan.manage')->with('success', 'Kosan beserta fotonya berhasil dihapus.');
    }

    public function test()
    {
        dd('Fungsi test() dipanggil'); // Debugging dengan dump dan die
        return view('welcome');
    }
    
}

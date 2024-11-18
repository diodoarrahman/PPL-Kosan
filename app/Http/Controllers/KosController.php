<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function index(){
        $kosans = Kosan::all();
        return view('mainpage', data: compact('kosans'));
    }
    public function manage()
    {
        $kosans = Kosan::all();
        return view('kos.manage',['kosans' => $kosans]);
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
            'alamat_kosan' => 'required|string',
            'harga_kosan' => 'required|integer',
            'kamar_tersedia' => 'required|integer',
            'jenis_kosan' => 'required|in:Putra,Putri,Campur',
            'deskripsi_kosan' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $kosan = Kosan::create([
            'nama_kosan' => $request->nama_kosan,
            'alamat_kosan' => $request->alamat_kosan,
            'harga_kosan' => $request->harga_kosan,
            'kamar_tersedia' => $request->kamar_tersedia,
            'jenis_kosan' => $request->jenis_kosan,
            'deskripsi_kosan' => $request->deskripsi_kosan,
            'user_id' => auth()->user()->id,
        ]);

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
            'alamat_kosan' => 'required|string',
            'harga_kosan' => 'required|integer',
            'kamar_tersedia' => 'required|integer',
            'jenis_kosan' => 'required|in:Putra,Putri,Campur',
            'deskripsi_kosan' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $kosan = Kosan::findOrFail($id);
        $kosan->update($request->only([
            'nama_kosan', 'alamat_kosan', 'harga_kosan', 'kamar_tersedia', 'jenis_kosan', 'deskripsi_kosan'
        ]));

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
}

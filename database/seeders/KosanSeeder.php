<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosan;

class KosanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kosan::create([
            'nama_kosan' => 'Kosan Mawar',
            'alamat_kosan' => 'Jl. Anggrek No. 10, Yogyakarta',
            'harga_kosan' => 500000,
            'kamar_tersedia' => 5,
            'jenis_kosan' => 'Putri',
            'deskripsi_kosan' => 'Kosan nyaman untuk putri, fasilitas lengkap.',
        ]);

        Kosan::create([
            'nama_kosan' => 'Kosan Melati',
            'alamat_kosan' => 'Jl. Melati No. 15, Yogyakarta',
            'harga_kosan' => 600000,
            'kamar_tersedia' => 3,
            'jenis_kosan' => 'Putra',
            'deskripsi_kosan' => 'Kosan khusus putra, lingkungan aman dan nyaman.',
        ]);

        Kosan::create([
            'nama_kosan' => 'Kosan Sakura',
            'alamat_kosan' => 'Jl. Sakura No. 5, Yogyakarta',
            'harga_kosan' => 750000,
            'kamar_tersedia' => 2,
            'jenis_kosan' => 'Campur',
            'deskripsi_kosan' => 'Kosan campur dengan fasilitas lengkap dan dekat kampus.',
        ]);
    }
}

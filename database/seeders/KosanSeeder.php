<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosan;

class KosanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 5, // Tambahkan user_id
                'nama_kosan' => 'Kosan Aman Sentosa',
                'alamat_kosan' => 'Jl. Mawar No. 23, Jakarta Selatan',
                'harga_kosan' => 1200000,
                'kamar_tersedia' => 3,
                'jenis_kosan' => 'Putri',
                'deskripsi_kosan' => 'Kosan nyaman dan aman untuk wanita. Dekat dengan pusat perbelanjaan.',
                'no_handphone' => '081234567890',
            ],
            [
                'user_id' => 5, // Tambahkan user_id
                'nama_kosan' => 'Kosan Harmoni Sejahtera',
                'alamat_kosan' => 'Jl. Kenanga No. 45, Bandung',
                'harga_kosan' => 850000,
                'kamar_tersedia' => 5,
                'jenis_kosan' => 'Putra',
                'deskripsi_kosan' => 'Lokasi strategis, dekat kampus dan transportasi umum.',
                'no_handphone' => '081345678901',
            ],
            [
                'user_id' => 5, // Tambahkan user_id
                'nama_kosan' => 'Kosan Mewah Abadi',
                'alamat_kosan' => 'Jl. Dahlia No. 12, Surabaya',
                'harga_kosan' => 1500000,
                'kamar_tersedia' => 2,
                'jenis_kosan' => 'Campur',
                'deskripsi_kosan' => 'Fasilitas lengkap dengan AC, Wi-Fi, dan parkir luas.',
                'no_handphone' => '081456789012',
            ],
            [
                'user_id' => 5, // Tambahkan user_id
                'nama_kosan' => 'Kosan Santai Asri',
                'alamat_kosan' => 'Jl. Melati No. 9, Yogyakarta',
                'harga_kosan' => 1000000,
                'kamar_tersedia' => 4,
                'jenis_kosan' => 'Putra',
                'deskripsi_kosan' => 'Suasana tenang dan asri, cocok untuk pelajar dan pekerja.',
                'no_handphone' => '081567890123',
            ],
            [
                'user_id' => 5, // Tambahkan user_id
                'nama_kosan' => 'Kosan Keluarga Bahagia',
                'alamat_kosan' => 'Jl. Anggrek No. 33, Malang',
                'harga_kosan' => 750000,
                'kamar_tersedia' => 6,
                'jenis_kosan' => 'Campur',
                'deskripsi_kosan' => 'Kosan bersih dengan dapur bersama dan ruang tamu luas.',
                'no_handphone' => '081678901234',
            ],
        ];

        foreach ($data as $item) {
            Kosan::create($item);
        }
    }
}

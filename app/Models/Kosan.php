<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosan extends Model
{
    use HasFactory;

    // Tambahkan $fillable untuk melindungi kolom dari mass assignment
    protected $fillable =
    ['nama_kosan',
    'alamat_kosan',
    'harga_kosan',
    'kamar_tersedia',
    'jenis_kosan',
    'deskripsi_kosan',
    'no_handphone',
    'user_id'];

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function photos() {
        return $this->hasMany(KosansPhoto::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tambahkan $fillable untuk melindungi kolom dari mass assignment
    protected $fillable = ['user_id', 'kosan_id', 'transaction_date', 'status', 'jumlah_transaksi'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function kosan() {
        return $this->belongsTo(Kosan::class);
    }
    
}

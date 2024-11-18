<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KosansPhoto extends Model
{
    use HasFactory;
     // Tambahkan $fillable untuk melindungi kolom dari mass assignment
     protected $fillable = ['kosan_id', 'photo_url', 'description'];
    public function kosan() {
        return $this->belongsTo(Kosan::class);
    }
    
}

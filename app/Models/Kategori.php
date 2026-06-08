<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailBuku;
use App\Models\Buku;

class Kategori extends Model
{
   protected $table = 'kategori';

    //inisialisasi PK
    protected $primaryKey = 'id';
    
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'id');
    }
}
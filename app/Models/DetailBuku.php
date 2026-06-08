<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\Kategori;

class DetailBuku extends Model
{
    //inisialisasi table
    protected $table = 'detail_buku';

    //inisialisasi PK
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }    

}
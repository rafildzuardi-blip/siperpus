<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\DetailBuku;

class BukuController extends Controller
{
    // cari deafult ke index
    public function index(Request $request)
    {
        // detail buku nya apa (pengaplikasian relasi)
        //$buku= Buku::find(1);  //cari buku nya
        //dd($buku->detail?->isbn); //cari detail buku nya

        //pakai with
        $buku= Buku::with('detail')->find(2);
        
        // dd($buku->detail?->isbn);
        $search = $request->keyword;

        $dataBuku = Buku::with(['detail','kategori'])->when($search, function($query, $search){
            return $query->where('judul', 'like', "%{$search}%")
            ->orWhere('penulis', 'like', "%{$search}%")
            ->orWhere('tahun_terbit', 'like', "%{$search}%")
            ->orWhereHas('detail', function($q2) use ($search){
                $q2->where('isbn','like', "%{$search}%");
            })
            ->orWhereHas('kategori', function($q2) use ($search){
                $q2->where('nama_kategori','like', "%{$search}%");
            });
        })
        ->orderBy('id', 'desc')
        // setiap halaman dibatasi cukup dengan ini
        ->paginate(5)
        ->withQueryString();

        return view('pages.buku.daftar-buku', compact('dataBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        
        return view('pages.buku.form-create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->judul);

        $validated = $request->validate(
            [
                'judul' => 'required|min:5',
                'penulis' => 'required|min:5',
                'harga' => 'required|numeric',
                'tahun_terbit' => 'required|numeric', 
                'isbn' => 'required|string|unique:detail_buku,isbn,',
                'jumlah_halaman' => 'required|numeric',
                'kategori_id' => 'required|integer',
            ],
            [
                'judul.required'=>'waduh judul bukunya jangan dikosongkan ya!',
                'judul.min'=>'judulnya terlalu pendek, minimal 3 karakter',
                'penulis.required'=>'setiap buku harus ada nama penulisnya!',
                'isbn.min'=>'isbn terlalu pendek, minimal 8 karakter',
                'isbn.unique'=> 'ISBN ini sudah terdaftar, gunakan yang lain!',
                'kategori_id.required' => 'Kategori buku belum dipilih!',
            ]
        );

        $buku = Buku::create($validated);
        $buku->detail()->create($validated);

        return redirect()->route('buku')->with('success', 'Buku baru berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //query db builder
        //$detailBuku = DB::table('buku')->where('id', $id)->firstOrFail();

        //orm
        // $detailBuku = Buku::find($id);
        $detailBuku = Buku::with(['detail', 'kategori'])->findOrFail($id);  

        return view('pages.buku.detail-buku', compact('detailBuku'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detailBuku = Buku::findOrFail($id);   
        $kategori = Kategori::all();     
        return view('pages.buku.form-create', compact('detailBuku','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'judul' => 'required|min:5',
                'penulis' => 'required|min:5',
                'harga' => 'required|numeric',
                'tahun_terbit' => 'required|numeric',   
                'isbn' => 'required|string|unique:detail_buku,isbn,' . $id . ',buku_id',
                'jumlah_halaman' => 'required|numeric',   
                'kategori_id' => 'required|integer',       
            ],
            [
                'judul.required'=>'waduh judul bukunya jangan dikosongkan ya!',
                'judul.min'=>'judulnya terlalu pendek, minimal 3 karakter',
                'penulis.required'=>'setiap buku harus ada nama penulisnya!',
                'isbn.unique'=> 'ISBN ini sudah terdaftar, gunakan yang lain!',
                'kategori_id.required' => 'Kategori buku belum dipilih!',
            ]
        );
        
        $buku = Buku::findOrFail($id);

        $buku->update([
            'judul'        => $validated['judul'],
            'penulis'      => $validated['penulis'],
            'harga'        => $validated['harga'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'kategori_id'  => $validated['kategori_id'],
        ]);

        //detail() ini nama fungsi relasi nya
        $buku->detail()->update([
            'isbn'           => $validated['isbn'],
            'jumlah_halaman' => $validated['jumlah_halaman'],
        ]);
        return redirect()->route('buku')->with('success', 'Data buku berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detailBuku = Buku::findOrFail($id);        
        $detailBuku->delete();
        return redirect()->route('buku')->with('success', 'Data buku berhasil dihapus!');
        
    }
}
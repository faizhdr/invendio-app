<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $keyword = $request->get('keyword');

        $ar_barang = DB::table('barang')
        ->join('merek', 'merek.id', '=', 'barang.idmerek')
        ->join('kategori', 'kategori.id', '=', 'barang.idkategori') 
        ->where('nama', 'like', '%'.$keyword.'%')
        ->orWhere('merek', 'like', '%'.$keyword.'%')
        ->orWhere('kategori', 'like', '%'.$keyword.'%')
        ->orWhere('kondisi', 'like', '%'.$keyword.'%')
        ->orWhere('keterangan', 'like', '%'.$keyword.'%')
        ->select(
            'barang.*',
            'merek.merek AS merek',
            'kategori.kategori AS kat')
        ->paginate(5);
        return view('Barang.index', compact('ar_barang', 'keyword'));

            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke hal form input barang
        return view('Barang.create');
    }

    public function barangPDF()
    {
        $ar_barang = DB::table('barang')
        ->join('merek', 'merek.id', '=', 'barang.idmerek')
        ->join('kategori', 'kategori.id', '=', 'barang.idkategori')
        ->select('barang.*', 'merek.merek AS merek', 'kategori.kategori AS kat')->get();
        $pdf = PDF::loadView('Barang.daftarBarang', ['ar_barang' => $ar_barang]);
        return $pdf->download('dataBarang.pdf');
    }

    public function barangCSV()
    {
        return Excel::download(new BarangExport, 'barang.csv');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // PROSES VALIDASI DATA
        $request->validate(
            [
                'nama' => 'required',
                'idmerek'=> 'required',
                'idkategori'=> 'required',
                'stok' => 'required',
                'kondisi' => 'required',
                'keterangan' => 'required',
            ],
            [
                'nama.required' => 'Kolom Nama Barang harus diisi',
                'idmerek.required' => 'Kolom Merek Barang harus diisi',
                'idkategori.required' => 'Kolom Kategori Barang harus diisi',
                'stok.required' => 'Kolom Stok harus diisi',
                'kondisi.required' => 'Kolom Kondisi Barang harus diisi',
                'keterangan.required' => 'Kolom Keterangan harus diisi',
            ]
        );

        if(!empty($request->foto)){
            $request->validate([
                'foto' => 'image|mimes:png,jpg,jpeg,giff|max:2048'
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'),$fileName);
        }else{
            $fileName = '';
        }

        // PROSES CREATE DATA

        // 1. Tangkap Request dari Form Create
        DB::table('barang')->insert(
            [
                'nama' => $request->nama,
                'foto' => $fileName,
                'idmerek' => $request->idmerek,
                'idkategori' => $request->idkategori,
                'stok' => $request->stok,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan,

            ]
        );

        // 2. Landing Page
        return redirect('/barang')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_barang = DB::table('barang') //join tabel dengan Query Builder Laravel
            ->join('merek', 'merek.id', '=', 'barang.idmerek')
            ->join('kategori', 'kategori.id', '=', 'barang.idkategori')
            ->select(
                'barang.*',
                'merek.merek AS merek',
                'kategori.kategori AS kat'
            )->where('barang.id', '=', $id)->get();
            
        return view('Barang.show', compact('ar_barang'));
    }

    public function totalBarang()
    {
        $barang = Barang::count();
        return view('pages.dashboard', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mengarahkan ke halaman form edit buku
        $data = DB::table('barang')
            ->where('id', '=', $id)->get();
        return view('Barang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // PROSES VALIDASI DATA
        $request->validate(
            [
                'nama' => 'required',
                'idmerek'=> 'required',
                'idkategori'=> 'required',
                'stok' => 'required',
                'kondisi' => 'required',
                'keterangan' => 'required',
            ],
            [
                'nama.required' => 'Kolom Nama Barang harus diisi',
                'idmerek.required' => 'Kolom Merek Barang harus diisi',
                'idkategori.required' => 'Kolom Kategori Barang harus diisi',
                'stok.required' => 'Kolom Stok harus diisi',
                'kondisi.required' => 'Kolom Kondisi Barang harus diisi',
                'keterangan.required' => 'Kolom Keterangan harus diisi',
            ]
        );

        if(!empty($request->foto)){
            $request->validate([
                'foto' => 'image|mimes:png,jpg,jpeg,giff|max:2048'
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'),$fileName);
        }else{
            $fileName = '';
        }
        // 1. Tangkap Request dari Form Update
        DB::table('barang')->where('id', '=', $id)->update(
            [
                'nama'=>$request->nama,
                'foto'=>$fileName,
                'idmerek'=>$request->idmerek,
                'idkategori'=>$request->idkategori,
                'stok'=>$request->stok,
                'kondisi'=>$request->kondisi,
                'keterangan'=>$request->keterangan,
            ]
        );

        // 2. Landing Page
        return redirect('/barang')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menghapus Data
        DB::table('barang')->where('id', $id)->delete();
        return redirect('barang')->with('success','Data berhasil dihapus');
    }
}

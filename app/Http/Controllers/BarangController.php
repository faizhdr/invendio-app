<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_barang = DB::table('barang') //join tabel dengan Query Builder Laravel
            ->join('merek', 'merek.id', '=', 'barang.idmerek')
            ->join('kategori', 'kategori.id', '=', 'barang.idkategori')
            ->select(
                'barang.*',
                'merek.nama AS merek',
                'kategori.nama AS kat'
            )->paginate(5);
            
        return view('Barang.index', compact('ar_barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke hal form input barang
        return view('Barang.form');
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
            ],
            [
                'nama.required' => 'Kolom Barang harus diisi',
            ]
        );

        // PROSES CREATE DATA

        // 1. Tangkap Request dari Form Create
        DB::table('barang')->insert(
            [
                'nama' => $request->nama,
                'idmerek' => $request->idmerek,
                'idkategori' => $request->idkategori,
                'keterangan' => $request->keterangan,

            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

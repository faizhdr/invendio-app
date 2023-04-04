<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_kategori = DB::table('kategori')->get();
        return view('Kategori.index', compact('ar_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke hal form input kategori
        return view('Kategori.create');
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
                'kategori' => 'required',
            ],
            [
                'kategori.required' => 'Kolom Kategori Barang harus diisi',
            ]
        );

        // 1. Tangkap Request dari Create
        DB::table('kategori')->insert(
            [
                'kategori' => $request->kategori,

            ]
        );

        return redirect('kategori')->with('success','Data berhasil ditambahkan');

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
        //mengarahkan ke halaman form edit buku
        $data = DB::table('kategori')
            ->where('id', '=', $id)->get();
        return view('Kategori.edit', compact('data'));
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
        $request->validate(
            [
                'kategori' => 'required',
            ],
            [
                'kategori.required' => 'Kolom Barang harus diisi',
            ]
        );

         // 1. Tangkap Request dari Form Update
         DB::table('kategori')->where('id', '=', $id)->update(
            [
                'kategori'=>$request->kategori,
            ]
        );

        // 2. Landing Page
        return redirect('kategori')->with('success','Data berhasil diupdate');    
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
        DB::table('kategori')->where('id', $id)->delete();
        return redirect('kategori')->with('success','Data berhasil dihapus');
    }
}

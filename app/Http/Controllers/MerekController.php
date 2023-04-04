<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_merek = DB::table('merek')->get();
        return view('Merek.index', compact('ar_merek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke hal form input kategori
        return view('Merek.create');
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
                'merek' => 'required',
            ],
            [
                'merek.required' => 'Kolom Merek Barang harus diisi',
            ]
        );

        // 1. Tangkap Request dari Create
        DB::table('merek')->insert(
            [
                'merek' => $request->merek,

            ]
        );

        return redirect('merek')->with('success','Data berhasil ditambahkan');

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
        $data = DB::table('merek')
            ->where('id', '=', $id)->get();
        return view('Merek.edit', compact('data'));
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
                'merek' => 'required',
            ],
            [
                'merek.required' => 'Kolom Merek Barang harus diisi',
            ]
        );

         // 1. Tangkap Request dari Form Update
         DB::table('merek')->where('id', '=', $id)->update(
            [
                'merek'=>$request->merek,
            ]
        );

        // 2. Landing Page
        return redirect('merek')->with('success','Data berhasil diupdate');    
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
        DB::table('merek')->where('id', $id)->delete();
        return redirect('merek')->with('success','Data berhasil dihapus');
    }
}

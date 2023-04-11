<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalBarang = Barang::count();
        $kondisi1 = Barang::where('kondisi', '1')->count();
        $kondisi2 = Barang::where('kondisi', '2')->count();
        $kondisi3 = Barang::where('kondisi', '3')->count();

        $ar_barang = DB::table('barang')
        ->join('merek', 'merek.id', '=', 'barang.idmerek')
        ->join('kategori', 'kategori.id', '=', 'barang.idkategori') 
        ->select(
            'barang.*',
            'merek.merek AS merek',
            'kategori.kategori AS kat')
        ->paginate(3);

        $ar_kategori = DB::table('kategori')->get();
        return view('pages.dashboard', compact('totalBarang', 'kondisi1', 'kondisi2', 'kondisi3', 'ar_barang', 'ar_kategori'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

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
        return view('pages.dashboard', compact('totalBarang', 'kondisi1', 'kondisi2', 'kondisi3'));
    }
}

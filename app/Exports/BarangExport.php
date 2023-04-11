<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Barang::all();
        $ar_barang = DB::table('barang') 
            ->join('merek', 'merek.id', '=', 'barang.idmerek')
            ->join('kategori', 'kategori.id', '=', 'barang.idkategori')
            ->select(
                'barang.nama',
                'barang.stok',
                'merek.merek AS merek',
                'kategori.kategori AS kat',
                'barang.kondisi',
                'barang.keterangan'
            )->get();
        return $ar_barang;
    }

    public function headings(): array
    {
        return [
            'Nama Barang', 'Stok', 'Merek', 'Kategori', 'Kondisi', 'Keterangan'
        ];
    }
}
